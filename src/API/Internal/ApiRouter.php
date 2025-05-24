<?php

declare(strict_types=1);

namespace Danielr\Demo\Src\API\Internal;

class ApiRouter
{
    public static function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? '';

        try {
            match ($method) {
                'POST' => '',
                'GET' => '',
                default => Response::notAllowed('Method not allowed')
            };
        } catch (\Exception $e) {
            Response::error($e->getMessage());
        }
    }

}
