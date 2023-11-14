<?php

namespace App\Adaptors\PokeApiAdaptor;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

/**
 * class PokeApiAdaptor
 * @package App\Adaptors\PokeApiAdaptor
 */
class PokeApiAdaptor
{
    /**
     * @param PendingRequest $httpClient
     */
    public function __construct(

        private PendingRequest $httpClient

    )
    {
        $this->httpClient = Http::withHeaders(config('poke.api.headers'));
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getList(int $offset, int $limit): array
    {
        $query = <<<GQL
            query {
                 pokemon_v2_pokemon(limit: $limit, offset: $offset) {
                     id
                     height
                     name
                     weight
                     pokemon_v2_pokemonsprites {
                     id
                     sprites
                   }
                }
            }
        GQL;

       return $this->execute($query)
           ->json('data.pokemon_v2_pokemon');
    }

    /**
     * @param string $query
     * @return Response
     */
    private function execute(string $query): Response
    {
        return $this->httpClient->post(
            config('poke.api.url'),
            ['query' => $query]
        );
    }
}
