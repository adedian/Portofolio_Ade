<?php

namespace App\Core;

/**
 * Minimal front-controller router.
 * Supports static segments and {param} placeholders.
 */
class Router
{
    private array $routes = [];

    public function get(string $pattern, callable|array $handler): void
    {
        $this->add('GET', $pattern, $handler);
    }

    public function post(string $pattern, callable|array $handler): void
    {
        $this->add('POST', $pattern, $handler);
    }

    private function add(string $method, string $pattern, callable|array $handler): void
    {
        $this->routes[] = [
            'method'  => $method,
            'pattern' => trim($pattern, '/'),
            'handler' => $handler,
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = trim(parse_url($uri, PHP_URL_PATH) ?? '/', '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $params = $this->match($route['pattern'], $uri);
            if ($params === null) {
                continue;
            }

            $this->invoke($route['handler'], $params);
            return;
        }

        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
    }

    private function match(string $pattern, string $uri): ?array
    {
        $patternParts = $pattern === '' ? [] : explode('/', $pattern);
        $uriParts     = $uri === '' ? [] : explode('/', $uri);

        if (count($patternParts) !== count($uriParts)) {
            return null;
        }

        $params = [];

        foreach ($patternParts as $i => $part) {
            if (preg_match('/^\{(\w+)\}$/', $part, $m)) {
                $params[$m[1]] = urldecode($uriParts[$i]);
                continue;
            }
            if ($part !== $uriParts[$i]) {
                return null;
            }
        }

        return $params;
    }

    private function invoke(callable|array $handler, array $params): void
    {
        if (is_array($handler)) {
            [$class, $method] = $handler;
            $controller = new $class();
            call_user_func_array([$controller, $method], $params);
            return;
        }

        call_user_func_array($handler, $params);
    }
}
