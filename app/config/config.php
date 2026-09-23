<?php
/**
 * Application configuration.
 * Adjust DB credentials for your local XAMPP / hosting environment.
 */

return [
    'app' => [
        'name'  => 'Ade Dian Sukmana',
        'env'   => 'local', // local | production
        'debug' => true,
    ],
    'db' => [
        'host'    => '127.0.0.1',
        'name'    => 'portfolio_ade',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4',
    ],
];
