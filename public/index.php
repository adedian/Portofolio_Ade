<?php
/**
 * Front controller. All requests are routed through this file.
 */

declare(strict_types=1);

$root = dirname(__DIR__);

require $root . '/app/config/config.php';
require $root . '/app/helpers/functions.php';

$config = require $root . '/app/config/config.php';
if (!empty($config['app']['debug'])) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}

spl_autoload_register(function (string $class) use ($root) {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $segments = explode('\\', $relative);
    $className = array_pop($segments);
    $segments = array_map('strtolower', $segments);
    $segments[] = $className;
    $path = $root . '/app/' . implode('/', $segments) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

use App\Core\App;

App::boot();
