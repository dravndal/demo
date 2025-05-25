<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Exceptions;

class HttpException extends ApiException
{
    public function __construct(string $message = 'HTTP request failed', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}