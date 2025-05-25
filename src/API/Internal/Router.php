<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Internal;

use Danielr\Demo\API\Controllers\PokemonController;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container) 
    {
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        $this->routes = [
            'GET' => [
                '/pokemon' => [PokemonController::class, 'getPokemon'],
                '/pokemon/list' => [PokemonController::class, 'getPokemonList'],
            ],
            'POST' => []
        ];
    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Strip /api.php prefix if present in the URL path
        if (str_contains($path, '/api.php')) {
            $path = str_replace('/api.php', '', $path);
        }
        
        // Default to /pokemon route when no specific path is provided
        if (empty($path) || $path === '/') {
            $path = '/pokemon';
        }

        if (!isset($this->routes[$method][$path])) {
            Response::notFound('Endpoint not found: ' . $path);
            return;
        }

        [$controllerClass, $action] = $this->routes[$method][$path];
        $controller = $this->container->get($controllerClass);
        $controller->$action();
    }
}
