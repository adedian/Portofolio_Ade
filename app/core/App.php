<?php

namespace App\Core;

use App\Controllers\AdminController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\ProjectController;

class App
{
    public static function boot(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $router = new Router();

        $router->get('', [HomeController::class, 'index']);
        $router->get('projects/{slug}', [ProjectController::class, 'show']);
        $router->post('contact', [ContactController::class, 'send']);

        $router->get('admin/login', [AdminController::class, 'loginForm']);
        $router->post('admin/login', [AdminController::class, 'login']);
        $router->post('admin/logout', [AdminController::class, 'logout']);
        $router->get('admin', [AdminController::class, 'dashboard']);
        $router->get('admin/projects', [AdminController::class, 'projectsIndex']);
        $router->get('admin/projects/new', [AdminController::class, 'projectCreateForm']);
        $router->get('admin/projects/{id}/edit', [AdminController::class, 'projectEditForm']);
        $router->post('admin/projects/save', [AdminController::class, 'projectSave']);
        $router->post('admin/projects/{id}/delete', [AdminController::class, 'projectDelete']);
        $router->get('admin/messages', [AdminController::class, 'messagesIndex']);
        $router->post('admin/messages/{id}/delete', [AdminController::class, 'messageDelete']);

        $router->dispatch(
            $_SERVER['REQUEST_METHOD'] ?? 'GET',
            self::currentPath()
        );
    }

    private static function currentPath(): string
    {
        $base = app_base_path();
        $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        if ($base !== '' && str_starts_with($requestUri, $base)) {
            $requestUri = substr($requestUri, strlen($base));
        }

        return '/' . trim($requestUri, '/');
    }
}
