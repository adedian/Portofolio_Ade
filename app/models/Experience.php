<?php

namespace App\Models;

use App\Core\Database;

class Experience
{
    public static function all(): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->query('SELECT * FROM experiences ORDER BY sort_order ASC');
        return $stmt->fetchAll();
    }
}
