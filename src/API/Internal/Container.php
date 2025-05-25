<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Internal;

use Danielr\Demo\API\Contracts\HttpClientInterface;
use Danielr\Demo\API\Contracts\PokeAPIInterface;
use Danielr\Demo\API\Contracts\PokemonServiceInterface;
use Danielr\Demo\API\Http\HttpClient;
use Danielr\Demo\API\External\PokeApi\PokeAPI;
use Danielr\Demo\API\Services\PokemonService;
use Danielr\Demo\API\Controllers\PokemonController;

class Container
{
    private array $instances = [];

    public function get(string $class): object
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        }

        return $this->instances[$class] = $this->create($class);
    }

    private function create(string $class): object
    {
        // Manual dependency injection 
        // each interface maps to its concrete implementation
        // Dependencies are automatically resolved through recursive $this->get() calls
        return match ($class) {
            HttpClientInterface::class => new HttpClient(),
            PokeAPIInterface::class => new PokeAPI($this->get(HttpClientInterface::class)),
            PokemonServiceInterface::class => new PokemonService($this->get(PokeAPIInterface::class)),
            PokemonController::class => new PokemonController($this->get(PokemonServiceInterface::class)),
            default => throw new \InvalidArgumentException("Cannot resolve class: {$class}")
        };
    }
}
