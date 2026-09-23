<?php

namespace App\Models;

use App\Core\Database;

class Message
{
    public static function create(array $data): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO messages (name, email, subject, message, ip_address, created_at)
             VALUES (:name, :email, :subject, :message, :ip, NOW())'
        );

        return $stmt->execute([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'ip'      => $data['ip'] ?? null,
        ]);
    }

    public static function all(): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public static function markRead(int $id): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare('UPDATE messages SET is_read = 1 WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return false;
        }

        $stmt = $pdo->prepare('DELETE FROM messages WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
