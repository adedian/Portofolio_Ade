<?php

/**
 * Global small helpers. Kept intentionally minimal.
 */

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function setting(array $settings, string $key, string $default = ''): string
{
    return $settings[$key] ?? $default;
}

function tags_to_array(?string $csv): array
{
    if (empty($csv)) {
        return [];
    }
    return array_map('trim', explode(',', $csv));
}

function lines_to_array(?string $text): array
{
    if (empty($text)) {
        return [];
    }
    return array_filter(array_map('trim', explode("\n", $text)));
}

/**
 * The app can be reached either via a vhost whose document root IS /public
 * (SCRIPT_NAME dir = "/" or "/some/prefix"), or via the root .htaccess that
 * forwards a plain htdocs folder into /public (SCRIPT_NAME dir ends with
 * "/public"). Either way, "/public" is never a real, browser-facing URL
 * segment — it gets stripped so base_url() reflects what's actually typed
 * in the address bar.
 */
function app_base_path(): string
{
    static $base = null;

    if ($base === null) {
        $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'));

        if ($dir === '/public') {
            $dir = '';
        } elseif (str_ends_with($dir, '/public')) {
            $dir = substr($dir, 0, -strlen('/public'));
        }

        $base = rtrim($dir, '/');
    }

    return $base;
}

function base_url(string $path = ''): string
{
    return app_base_path() . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return base_url('assets/' . ltrim($path, '/'));
}
