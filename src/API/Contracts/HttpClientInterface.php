<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Contracts;

interface HttpClientInterface
{
    public function get(string $uri, array $headers = []): array;
    public function post(string $uri, array $data = [], array $headers = []): array;
}