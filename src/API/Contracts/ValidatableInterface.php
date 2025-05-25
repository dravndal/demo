<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Contracts;

interface ValidatableInterface
{
    public function validate(): bool;
    public function getErrors(): array;
}