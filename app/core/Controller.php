<?php

namespace App\Core;

abstract class Controller
{
    /**
     * Render a view file with the given data extracted into scope.
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!is_file($viewPath)) {
            http_response_code(500);
            echo 'View not found: ' . htmlspecialchars($view);
            return;
        }

        require $viewPath;
    }

    protected function json(array $payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    protected function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }
}
