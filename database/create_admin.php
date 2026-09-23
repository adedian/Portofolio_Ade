<?php
/**
 * One-time CLI helper to create the first admin user.
 *
 * Usage:
 *   php database/create_admin.php "Ade Dian Sukmana" admin@example.com yourpassword
 */

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    exit("This script can only be run from the command line.\n");
}

$root = dirname(__DIR__);
require $root . '/app/config/config.php';

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

use App\Models\User;

[$script, $name, $email, $password] = array_pad($argv, 4, null);

if (!$name || !$email || !$password) {
    exit("Usage: php database/create_admin.php \"Full Name\" email@example.com password\n");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please provide a valid email address.\n");
}

if (strlen($password) < 8) {
    exit("Password should be at least 8 characters.\n");
}

if (User::findByEmail($email)) {
    exit("A user with that email already exists.\n");
}

if (User::create($name, $email, $password)) {
    echo "Admin user created. You can now log in at /admin/login\n";
} else {
    echo "Failed to create admin user. Check your database connection in app/config/config.php\n";
}
