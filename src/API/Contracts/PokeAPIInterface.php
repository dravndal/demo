<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Contracts;

interface PokeAPIInterface
{
    public function getPokemon(string $name): array;
    public function getPokemonList(int $limit = 20, int $offset = 0): array;
}