<?php
namespace modules\controllers;

use modules\views\passwordView;
use PDO;

require_once __DIR__ . '/../../assets/includes/database.php';
require_once __DIR__ . '/../../assets/includes/Mailer.php';

class passwordController
{
    private PDO $pdo;
    private \Mailer $mailer;

    public function __construct()
    {
        $this->pdo = \Database::getInstance();
        $this->mailer = new \Mailer();

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            header('Location: /?page=dashboard');
            return;
        }

        $msg = $_SESSION['pw_msg'] ?? null;
        unset($_SESSION['pw_msg']);

        $view = new passwordView();
        $view->show($msg);
    }

    public function post(): void
    {
        if ($this->isUserLoggedIn()) {
            header('Location: /?page=dashboard');
            return;
        }

        $action = $_POST['action'] ?? '';
        if ($action === 'send_code') {
            $this->handleSendCode();
        } elseif ($action === 'reset_password') {
            $this->handleReset();
        } else {
            $_SESSION['pw_msg'] = ['type' => 'error', 'text' => 'Action inconnue.'];
            header('Location: /?page=password');
        }
    }

    private function handleSendCode(): void
    {
        $email = trim($_POST['email'] ?? '');
        $generic = "Si un compte correspond, un code de réinitialisation a été envoyé.";

        if ($email === '') {
            $_SESSION['pw_msg'] = ['type'=>'error','text'=>'Email requis.'];
            header('Location: /?page=password');
            return;
        }

        $st = $this->pdo->prepare("SELECT id_user, email, first_name FROM users WHERE email = :e LIMIT 1");
        $st->execute([':e' => $email]);
        $user = $st->fetch();

        $_SESSION['pw_msg'] = ['type'=>'info','text'=>$generic];

        if (!$user) {
            header('Location: /?page=password');
            return;
        }

        $token = bin2hex(random_bytes(16));
        $code  = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $codeHash = password_hash($code, PASSWORD_DEFAULT);
        $expires  = (new \DateTime('+20 minutes'))->format('Y-m-d H:i:s');

        $upd = $this->pdo->prepare(
            "UPDATE users SET reset_token=:t, reset_code_hash=:c, reset_expires=:x WHERE id_user=:id"
        );
        $upd->execute([':t'=>$token, ':c'=>$codeHash, ':x'=>$expires, ':id'=>$user['id_user']]);

        // Envoie e-mail
        $appUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
        $link   = $appUrl ? $appUrl . "/?page=password&token={$token}" : "/?page=password&token={$token}";

        $html = "<p>Bonjour,</p>
                 <p>Votre code de réinitialisation est&nbsp;: <strong style='font-size:20px'>{$code}</strong></p>
                 <p>Ce code expire dans 20 minutes.</p>
                 <p>Ou cliquez ici pour continuer : <a href='{$link}'>Réinitialiser le mot de passe</a></p>";

        try {
            $this->mailer->send($user['email'], 'Votre code de réinitialisation', $html);
        } catch (\Throwable $e) {
            error_log('[Password] Mail send failed: ' . $e->getMessage());
        }

        header('Location: /?page=password&token='.$token);
    }

    private function handleReset(): void
    {
        $token = $_POST['token'] ?? '';
        $code  = $_POST['code']  ?? '';
        $pass  = $_POST['password'] ?? '';

        if (!preg_match('/^[a-f0-9]{32}$/', $token)) {
            $_SESSION['pw_msg'] = ['type'=>'error','text'=>'Lien/token invalide.'];
            header('Location: /?page=password');
            return;
        }
        if (strlen($pass) < 8) {
            $_SESSION['pw_msg'] = ['type'=>'error','text'=>'Mot de passe trop court (min 8).'];
            header('Location: /?page=password&token='.$token);
            return;
        }

        $st = $this->pdo->prepare(
            "SELECT id_user, reset_code_hash, reset_expires 
             FROM users 
             WHERE reset_token=:t LIMIT 1"
        );
        $st->execute([':t'=>$token]);
        $u = $st->fetch();

        if (!$u || !$u['reset_expires'] || new \DateTime($u['reset_expires']) < new \DateTime()) {
            $_SESSION['pw_msg'] = ['type'=>'error','text'=>'Code expiré ou invalide.'];
            header('Location: /?page=password');
            return;
        }

        if (!password_verify($code, $u['reset_code_hash'])) {
            $_SESSION['pw_msg'] = ['type'=>'error','text'=>'Code incorrect.'];
            header('Location: /?page=password&token='.$token);
            return;
        }

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $this->pdo->beginTransaction();
        $upd = $this->pdo->prepare(
            "UPDATE users 
             SET password=:p, reset_token=NULL, reset_code_hash=NULL, reset_expires=NULL 
             WHERE id_user=:id"
        );
        $upd->execute([':p'=>$hash, ':id'=>$u['id_user']]);
        $this->pdo->commit();

        $_SESSION['pw_msg'] = ['type'=>'success','text'=>'Mot de passe mis à jour. Vous pouvez vous connecter.'];
        header('Location: /?page=signin');
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['email']);
    }
}
