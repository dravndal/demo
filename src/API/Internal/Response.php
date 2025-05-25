<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Internal;

use Danielr\Demo\API\AbstractResponse;

class Response extends AbstractResponse
{
    public static function success(array $data = [], ?string $message = null, int $statusCode = self::HTTP_OK): void
    {
        $response = new self($statusCode, $data, $message);
        $response->send();
    }

    public static function error(string $message, int $statusCode = self::HTTP_INTERNAL_SERVER_ERROR, array $data = []): void
    {
        $response = new self($statusCode, $data, $message);
        $response->send();
    }

    public static function notFound(string $message = 'Resource not found'): void
    {
        $response = new self(self::HTTP_NOT_FOUND, [], $message);
        $response->send();
    }

    public static function notAllowed(string $message = 'Method not allowed'): void
    {
        $response = new self(self::HTTP_METHOD_NOT_ALLOWED, [], $message);
        $response->send();
    }

    public static function badRequest(string $message = 'Bad request', array $data = []): void
    {
        $response = new self(self::HTTP_BAD_REQUEST, $data, $message);
        $response->send();
    }

    public static function unauthorized(string $message = 'Unauthorized'): void
    {
        $response = new self(self::HTTP_UNAUTHORIZED, [], $message);
        $response->send();
    }

    public static function forbidden(string $message = 'Forbidden'): void
    {
        $response = new self(self::HTTP_FORBIDDEN, [], $message);
        $response->send();
    }

    protected function validate(): bool
    {
        return $this->statusCode >= 100 && $this->statusCode < 600;
    }

    public function send(): void
    {
        if (!$this->validate()) {
            throw new \InvalidArgumentException('Invalid HTTP status code: ' . $this->statusCode);
        }

        http_response_code($this->statusCode);
        
        foreach ($this->getHeaders() as $name => $value) {
            header("{$name}: {$value}");
        }
        
        header('Content-Type: application/json');
        
        echo $this->toJson();
        exit;
    }
}
