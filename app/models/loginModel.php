<?php

namespace modules\models;

use PDO;

class loginModel
{
    private PDO $pdo;
    private string $table;

    public function __construct(PDO $pdo, string $table = 'users')
    {
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function getByEmail(string $email): ?array
    {
        $sql = "SELECT id_user, first_name, last_name, email, password, profession, admin_status
                FROM {$this->table}
                WHERE email = :email
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function verifyCredentials(string $email, string $plainPassword): ?array
    {
        $user = $this->getByEmail($email);
        if (!$user) {
            return null;
        }
        if (!password_verify($plainPassword, $user['password'])) {
            return null;
        }
        unset($user['password']);
        return $user;
    }
}
