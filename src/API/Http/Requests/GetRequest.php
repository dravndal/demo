<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Http\Requests;

use Danielr\Demo\API\AbstractRequest;

class GetRequest extends AbstractRequest
{
    public function __construct(string $uri, array $headers = [])
    {
        parent::__construct('GET', $uri, $headers);
    }

    public function validate(): bool
    {
        $this->errors = [];

        if (empty($this->uri)) {
            $this->errors[] = 'URI is required';
        }

        if (!filter_var($this->uri, FILTER_VALIDATE_URL) && !str_starts_with($this->uri, '/')) {
            $this->errors[] = 'Invalid URI format';
        }

        return empty($this->errors);
    }
}