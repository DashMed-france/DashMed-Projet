<?php

declare(strict_types=1);

namespace modules\models;

use PDO;
use PDOException;

class signinModel
{
    private PDO $pdo;
    private string $table;

    public function __construct(PDO $pdo, string $table = 'users')
    {
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo   = $pdo;
        $this->table = $table;
    }

    public function getByEmail(string $email): ?array
    {
        $sql = "SELECT id_user, first_name, last_name, email, password, profession, admin_status
                FROM {$this->table}
                WHERE email = :email
                LIMIT 1";
        $st = $this->pdo->prepare($sql);
        $st->execute([':email' => $email]);
        $row = $st->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO {$this->table}
                (first_name, last_name, email, password, profession, admin_status)
                VALUES (:first_name, :last_name, :email, :password, :profession, :admin_status)";
        $st = $this->pdo->prepare($sql);
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);

        try {
            $st->execute([
                ':first_name'   => $data['first_name'],
                ':last_name'    => $data['last_name'],
                ':email'        => $data['email'],
                ':password'     => $hash,
                ':profession'   => $data['profession'] ?? null,
                ':admin_status' => (int)($data['admin_status'] ?? 0),
            ]);
        } catch (PDOException $e) {
            throw $e;
        }

        return (int)$this->pdo->lastInsertId();
    }
}
