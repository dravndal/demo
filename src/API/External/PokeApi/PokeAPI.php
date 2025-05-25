<?php

declare(strict_types=1);

namespace Danielr\Demo\API\External\PokeApi;

use Danielr\Demo\API\Contracts\HttpClientInterface;
use Danielr\Demo\API\Contracts\PokeAPIInterface;
use Danielr\Demo\API\Exceptions\ApiException;

class PokeAPI implements PokeAPIInterface
{
    public const BASE_URI = 'https://pokeapi.co/api/v2/';

    public function __construct(private HttpClientInterface $httpClient) {}

    public function getPokemon(string $name): array
    {
        try {
            return $this->httpClient->get(self::BASE_URI . 'pokemon/' . strtolower($name));
        } catch (\Exception $e) {
            throw new ApiException('Failed to fetch Pokemon: ' . $e->getMessage(), 500, $e);
        }
    }

    public function getPokemonList(int $limit = 20, int $offset = 0): array
    {
        try {
            return $this->httpClient->get(self::BASE_URI . "pokemon?limit={$limit}&offset={$offset}");
        } catch (\Exception $e) {
            throw new ApiException('Failed to fetch Pokemon list: ' . $e->getMessage(), 500, $e);
        }
    }
}
