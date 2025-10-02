<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class Mailer
{
    private PHPMailer $m;

    public function __construct()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $host = $_ENV['SMTP_HOST'] ?? '';
        $user = $_ENV['SMTP_USER'] ?? '';
        $pass = $_ENV['SMTP_PASS'] ?? '';
        $port = (int)($_ENV['SMTP_PORT'] ?? 465);
        $sec  = strtolower($_ENV['SMTP_SECURE'] ?? 'ssl');

        $this->m = new PHPMailer(true);
        $this->m->isSMTP();
        $this->m->Host       = $host;
        $this->m->SMTPAuth   = true;
        $this->m->Username   = $user;
        $this->m->Password   = $pass;
        $this->m->Port       = $port;
        $this->m->CharSet    = 'UTF-8';

        if ($sec === 'ssl') {
            $this->m->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $this->m->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        
        if (!empty($user)) {
            $this->m->setFrom($user, 'Support');
        }
    }

    public function send(string $to, string $subject, string $html): void
    {
        $this->m->clearAddresses();
        $this->m->isHTML(true);
        $this->m->addAddress($to);
        $this->m->Subject = $subject;
        $this->m->Body    = $html;
        $this->m->AltBody = strip_tags($html);
        $this->m->send();
    }
}
