<?php

// Provides simple method-and-path based routing for the application.
class Router
{
// Store all registered application routes.
    private array $routes = [];

// Register an HTTP method, URL pattern, and controller handler.
    public function add(string $method, string $path, array $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

// Match the current request to a registered route and execute its handler.
    public function dispatch(string $method, string $uri): void
    {
// Extract only the URL path from the incoming request URI.
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

// Determine the application subdirectory when running under a local server.
        $scriptDir = rtrim(
            str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')),
            '/'
        );

        if ($scriptDir && str_starts_with($path, $scriptDir)) {
            $path = substr($path, strlen($scriptDir)) ?: '/';
        }

// Check each registered route until a matching method and path are found.
        foreach ($this->routes as $route) {
            if (strtoupper($method) !== $route['method']) {
                continue;
            }

// Convert route parameters such as {id} into regular-expression capture groups.
            $pattern = preg_replace(
                '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
                '([^/]+)',
                $route['path']
            );

// Execute the controller action when the generated route pattern matches the request.
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                array_shift($matches);

                [$class, $action] = $route['handler'];
                (new $class())->{$action}(...$matches);

                return;
            }
        }

// Return a 404 response when no registered route matches.
        http_response_code(404);
        require __DIR__ . '/../views/layout/404.php';
    }
}
