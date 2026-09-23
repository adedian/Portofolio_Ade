<?php

namespace App\Core;

/**
 * Session-based CSRF token helper.
 */
class Csrf
{
    private const KEY = '_csrf_token';

    public static function token(): string
    {
        if (empty($_SESSION[self::KEY])) {
            $_SESSION[self::KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::KEY];
    }

    public static function verify(?string $token): bool
    {
        if (empty($_SESSION[self::KEY]) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION[self::KEY], $token);
    }
}
