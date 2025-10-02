<?php
namespace modules\controllers;

use modules\views\profileView;
use PDO;

require_once __DIR__ . '/../../assets/includes/database.php';

class profileController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = \Database::getInstance();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public function get(): void
    {
        if (!$this->isUserLoggedIn()) {
            header('Location: /?page=signin'); exit;
        }

        $user = $this->getUserByEmail($_SESSION['email']);
        $specialties = $this->getAllSpecialties();

        $msg = $_SESSION['profile_msg'] ?? null;
        unset($_SESSION['profile_msg']);

        $view = new profileView();
        $view->show($user, $specialties, $msg);
    }

    public function post(): void
    {
        if (!$this->isUserLoggedIn()) {
            header('Location: /?page=signin'); exit;
        }

        if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf_profile'] ?? '', $_POST['csrf'])) {
            $_SESSION['profile_msg'] = ['type'=>'error','text'=>'Session expirée, réessayez.'];
            header('Location: /?page=profile'); exit;
        }

        $first = trim($_POST['first_name'] ?? '');
        $last  = trim($_POST['last_name'] ?? '');
        $profId = $_POST['profession_id'] ?? null;

        if ($first === '' || $last === '') {
            $_SESSION['profile_msg'] = ['type'=>'error','text'=>'Le prénom et le nom sont obligatoires.'];
            header('Location: /?page=profile'); exit;
        }

        $validId = null;
        if ($profId !== null && $profId !== '') {
            $st = $this->pdo->prepare("SELECT id FROM medical_specialties WHERE id = :id");
            $st->execute([':id' => $profId]);
            $validId = $st->fetchColumn() ?: null;
            if ($validId === null) {
                $_SESSION['profile_msg'] = ['type'=>'error','text'=>'Spécialité invalide.'];
                header('Location: /?page=profile'); exit;
            }
        }

        $upd = $this->pdo->prepare("
            UPDATE users 
               SET first_name = :f, last_name = :l, profession_id = :p
             WHERE email = :e
        ");
        $upd->execute([
            ':f' => $first,
            ':l' => $last,
            ':p' => $validId,
            ':e' => $_SESSION['email']
        ]);

        $_SESSION['profile_msg'] = ['type'=>'success','text'=>'Profil mis à jour ✅'];
        header('Location: /?page=profile'); exit;
    }

    private function getUserByEmail(string $email): ?array
    {
        $sql = "SELECT u.first_name, u.last_name, u.email, u.profession_id,
                       ms.name AS profession_name
                  FROM users u
             LEFT JOIN medical_specialties ms ON ms.id = u.profession_id
                 WHERE u.email = :e";
        $st = $this->pdo->prepare($sql);
        $st->execute([':e' => $email]);
        return $st->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    private function getAllSpecialties(): array
    {
        $st = $this->pdo->query("SELECT id, name FROM medical_specialties ORDER BY name");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['email']);
    }
}
