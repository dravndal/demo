<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Internal;

class ApiRouter
{
    public static function handleRequest(): void
    {
        $container = new Container();
        $router = new Router($container);
        
        try {
            $router->handleRequest();
        } catch (\Exception $e) {
            Response::error($e->getMessage());
        }
    }
}
