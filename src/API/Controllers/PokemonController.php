<?php

declare(strict_types=1);

namespace Danielr\Demo\API\Controllers;

use Danielr\Demo\API\Services\PokemonService;
use Danielr\Demo\API\Internal\Response;
use Danielr\Demo\API\Exceptions\ValidationException;
use Danielr\Demo\API\Exceptions\ApiException;

class PokemonController
{
    public function __construct(private PokemonService $pokemonService) {}

    public function getPokemon(): void
    {
        try {
            $name = $_GET['name'] ?? '';
            $data = $this->pokemonService->getPokemon($name);
            Response::success($data);
        } catch (ValidationException $e) {
            Response::badRequest($e->getMessage(), $e->getErrors());
        } catch (ApiException $e) {
            Response::error($e->getMessage(), $e->getCode());
        }
    }

    public function getPokemonList(): void
    {
        try {
            $limit = (int)($_GET['limit'] ?? 20);
            $offset = (int)($_GET['offset'] ?? 0);
            $data = $this->pokemonService->getPokemonList($limit, $offset);
            Response::success($data);
        } catch (ValidationException $e) {
            Response::badRequest($e->getMessage(), $e->getErrors());
        } catch (ApiException $e) {
            Response::error($e->getMessage(), $e->getCode());
        }
    }
}