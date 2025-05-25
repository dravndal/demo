<?php

declare(strict_types=1);

namespace Danielr\Demo\API;

use Danielr\Demo\API\Contracts\RequestInterface;
use Danielr\Demo\API\Contracts\ValidatableInterface;

abstract class AbstractRequest implements RequestInterface, ValidatableInterface
{
    protected array $errors = [];

    public function __construct(
        protected string $method,
        protected string $uri,
        protected array $headers = [],
        protected array $body = []
    ) {}

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    abstract public function validate(): bool;
}