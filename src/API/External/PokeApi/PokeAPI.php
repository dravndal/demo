<?php

declare(strict_types=1);

namespace Danielr\Demo\Src\API\External\PokeApi;

class PokeAPI
{
    const BASE_URI = 'https://pokeapi.co/api/v2/';

    public static function getPokemonEndpoint() {}
    public static function getPokemonTypesEndpoint() {}
    public static function getLocationsEndpoint() {}

    // The PokeApi does not require any authentication
    // however in the case that an API requires auth
    // I like to have this function because it creates a fluent
    // and very readable API for accessing the token
    // on a specific API by calling something like 
    //
    // PokeAPI::getToken();
    //
    public static function getToken() {}
}
