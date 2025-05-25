<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Exceptions;

class ApiException extends \Exception
{
    public function __construct(string $message = '', int $code = 500)
    {
        parent::__construct($message, $code);
    }
}