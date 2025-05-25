<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Exceptions;

class ValidationException extends ApiException
{
    private array $errors;

    public function __construct(array $errors = [], string $message = 'Validation failed', int $code = 400)
    {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}