<?php

declare(strict_types=1);

namespace Danielr\Demo\API;

interface ResponseInterface
{
    public function getStatusCode(): int;
    public function getData(): array;
    public function getMessage(): ?string;
    public function isSuccess(): bool;
    public function toArray(): array;
    public function toJson(): string;
}

