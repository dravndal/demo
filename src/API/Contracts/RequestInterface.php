<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Contracts;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getHeaders(): array;
    public function getBody(): array;
    public function validate(): bool;
}