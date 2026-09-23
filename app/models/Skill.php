<?php

namespace App\Models;

use App\Core\Database;

class Skill
{
    /**
     * Returns skills grouped by category, preserving insertion/category order.
     */
    public static function grouped(): array
    {
        $pdo = Database::connection();
        if (!$pdo) {
            return [];
        }

        $stmt = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id ASC');
        $rows = $stmt->fetchAll();

        $order = ['Development', 'UI / UX', 'Systems', 'Tools'];
        $grouped = array_fill_keys($order, []);

        foreach ($rows as $row) {
            $grouped[$row['category']][] = $row;
        }

        return array_filter($grouped);
    }
}
