<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Services;

use Danielr\Demo\API\Contracts\PokeAPIInterface;
use Danielr\Demo\API\Contracts\PokemonServiceInterface;
use Danielr\Demo\API\Exceptions\ValidationException;

class PokemonService implements PokemonServiceInterface
{
    public function __construct(private PokeAPIInterface $pokeApi) {}

    public function getPokemon(string $name): array
    {
        if (empty(trim($name))) {
            throw new ValidationException(['name' => 'Pokemon name is required']);
        }

        return $this->pokeApi->getPokemon($name);
    }

    public function getPokemonList(int $limit = 20, int $offset = 0): array
    {
        if ($limit < 1 || $limit > 100) {
            throw new ValidationException(['limit' => 'Limit must be between 1 and 100']);
        }

        if ($offset < 0) {
            throw new ValidationException(['offset' => 'Offset must be non-negative']);
        }

        return $this->pokeApi->getPokemonList($limit, $offset);
    }
}
