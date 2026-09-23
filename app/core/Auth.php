<?php

namespace App\Core;

class Auth
{
    public static function login(int $userId): void
    {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $userId;
    }

    public static function logout(): void
    {
        unset($_SESSION['admin_id']);
        session_regenerate_id(true);
    }

    public static function check(): bool
    {
        return !empty($_SESSION['admin_id']);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: ' . base_url('admin/login'));
            exit;
        }
    }
}
