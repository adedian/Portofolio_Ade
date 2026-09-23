<?php

namespace App\Models;

use App\Core\Database;

class User
{
    public static function findByEmail(string $email): ?array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return null;
        }

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public static function count(): int
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return 0;
        }

        return (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    }

    public static function create(string $name, string $email, string $password): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :hash)'
        );

        return $stmt->execute([
            'name'  => $name,
            'email' => $email,
            'hash'  => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}
