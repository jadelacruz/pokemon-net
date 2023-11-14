<?php

namespace App\Services\Pokemon\ListPokemonService;

use App\Adaptors\PokeApiAdaptor\PokeApiAdaptor;
use App\Constants\PokemonConstant;
use App\Http\Requests\ListPokemonRequest;
use Illuminate\Support\Facades\Cache;

/**
 * class ListPokemonService
 * @package App\Services\Pokemon\ListPokemonService
 */
class ListPokemonService
{
    /**
     * @param PokeApiAdaptor $pokeApiAdaptor
     */
    public function __construct(

        private PokeApiAdaptor $pokeApiAdaptor

    ) {}

    /**
     * @param ListPokemonRequest $request
     * @return array|mixed
     */
    public function handle(ListPokemonRequest $request)
    {
        $cacheListKey = sprintf(PokemonConstant::CACHE_LIST_KEY, $request->getOffset(), $request->getLimit());
        $cache = Cache::get($cacheListKey);

        if (!empty($cache)) {
            return $cache;
        }

        $pokemonList = $this->pokeApiAdaptor
            ->getList(
                offset: $request->getOffset(),
                limit : $request->getLimit()
            );


        Cache::add($cacheListKey, $pokemonList, config('poke.cache.ttl'));

        return $pokemonList;
    }
}
