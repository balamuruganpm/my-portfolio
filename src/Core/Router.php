<?php
namespace App\Core;

/**
 * Router Engine — Parses HTTP request URIs and dispatches to Controller actions.
 */
class Router
{
    private array $routes = [];
    private string $basePath;

    public function __construct(string $basePath = '')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    /**
     * Add route rule
     */
    public function add(string $method, string $path, array $handler): void
    {
        $method = strtoupper($method);
        $path = '/' . trim($path, '/');
        if ($path === '//') $path = '/';

        $this->routes[] = [
            'method'  => $method,
            'path'    => $path,
            'handler' => $handler,
        ];
    }

    public function get(string $path, array $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    /**
     * Resolve current HTTP request
     */
    public function dispatch(string $requestMethod, string $requestUri, callable $containerResolver): void
    {
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
        $path = urldecode($path);

        // Strip subfolder prefix if present
        if (!empty($this->basePath) && strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }

        $path = '/' . trim($path, '/');
        if ($path === '//') $path = '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod && $route['method'] !== 'ANY') {
                continue;
            }

            // Match static route
            if ($route['path'] === $path) {
                $containerResolver($route['handler'], []);
                return;
            }

            // Match dynamic route patterns like /blogs/{slug} or /category/{name}
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#i';

            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $containerResolver($route['handler'], $params);
                return;
            }
        }

        // Fallback 404 handler
        http_response_code(404);
        $containerResolver([\App\Controllers\HomeController::class, 'notFound'], []);
    }
}
