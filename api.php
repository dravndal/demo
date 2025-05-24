<?php

declare(strict_types=1);

namespace Danielr\Demo;

use Danielr\Demo\Src\API\Internal\ApiRouter;

try {
    ApiRouter::handleRequest();
} catch (\Exception $e) {
    Response::error('message');
}
