<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ListPokemonRequest;
use App\Http\Resources\PokemonCollection;
use App\Services\Pokemon\ListPokemonService\ListPokemonService;
use Illuminate\Http\JsonResponse;

/**
 * class PokemonApiController
 * @package App\Http\Controllers\Api
 */
class PokemonApiController
{
    /**
     * @param ListPokemonRequest $request
     * @param ListPokemonService $service
     * @return JsonResponse
     */
    public function list(
        ListPokemonRequest $request,
        ListPokemonService $service
    ): JsonResponse
    {
        $list = $service->handle($request);

        return response()
            ->json(new PokemonCollection($list));
    }

}
