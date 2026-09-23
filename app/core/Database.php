<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Thin PDO singleton wrapper. Fails loudly and safely (no credential leakage)
 * when the database is unreachable, so pages degrade gracefully.
 */
class Database
{
    private static ?PDO $instance = null;

    public static function connection(): ?PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $config = require __DIR__ . '/../config/config.php';
        $db = $config['db'];

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $db['host'],
            $db['name'],
            $db['charset']
        );

        try {
            self::$instance = new PDO($dsn, $db['user'], $db['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log('[DB CONNECTION ERROR] ' . $e->getMessage());
            self::$instance = null;
        }

        return self::$instance;
    }
}
