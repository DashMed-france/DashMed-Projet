<?php
declare(strict_types=1);

final class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance instanceof PDO) {
            return self::$instance;
        }

        $envPath = __DIR__ . '/../../.env';
        if (!is_file($envPath) || !is_readable($envPath)) {
            error_log('[Database] .env introuvable ou illisible à ' . $envPath);
            http_response_code(500);
            echo '500 — Erreur serveur (.env manquant).';
            exit;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;

            [$name, $value] = array_pad(explode('=', $line, 2), 2, '');
            $name  = trim($name);
            $value = trim($value);

            if ($name !== '') {
                $_ENV[$name]    = $value;
                $_SERVER[$name] = $value;
                putenv("$name=$value");
            }
        }

        $required = ['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME'];
        foreach ($required as $key) {
            if (!array_key_exists($key, $_ENV) || trim((string)$_ENV[$key]) === '') {
                error_log("[Database] Variable $key manquante ou vide dans .env");
                http_response_code(500);
                echo '500 — Erreur serveur (configuration DB incomplète).';
                exit;
            }
        }

        $host    = trim((string)$_ENV['DB_HOST']);
        $name    = trim((string)$_ENV['DB_NAME']);
        $user    = trim((string)$_ENV['DB_USER']);
        $pass    = (string)$_ENV['DB_PASS'];
        $port    = isset($_ENV['DB_PORT']) && trim((string)$_ENV['DB_PORT']) !== '' ? trim((string)$_ENV['DB_PORT']) : null;
        $charset = 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$name};charset={$charset}";
        if ($port !== null) {
            $dsn = "mysql:host={$host};port={$port};dbname={$name};charset={$charset}";
        }

        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

            $portInfo = $port !== null ? $port : '(default)';
            error_log("[Database] Connected DSN host={$host} port={$portInfo} db={$name}");

            self::$instance = $pdo;
            return $pdo;

        } catch (PDOException $e) {
            error_log('[Database] Connection failed: ' . $e->getMessage() . " | DSN={$dsn} | user={$user}");
            http_response_code(500);
            echo '500 — Erreur serveur (connexion DB).';
            exit;
        }
    }

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {}
}
