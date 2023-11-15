<?php

namespace App\Http\Controllers\Api;

use App\Adaptors\PokeApiAdaptor\PokeApiAdaptor;
use App\Exceptions\User\EmailTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListTrainerRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\PokemonCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\CreateUserService\CreateUserService;
use App\Services\User\UpdateUserService\UpdateUserService;
use Illuminate\Http\JsonResponse;
use ErrorException;

/**
 * class UserApiController
 * @package App\Http\Controllers\Api
 */
class UserApiController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $user = auth()->guard('sanctum')->user();
        return response()->json(
            new UserResource($user)
        );
    }

    /**
     * @param ListTrainerRequest $request
     * @param PokeApiAdaptor $adaptor
     * @return JsonResponse
     */
    public function list(
        ListTrainerRequest $request,
        PokeApiAdaptor $adaptor
    ): Jsonresponse
    {
        $user  = request()->user('sanctum');
        $limit = 5;
        $users = User::with('picks')
            ->offset($request->getPage() * $limit)
            ->where('id', '!=', $user->id)
            ->limit($limit)
            ->get();
        $totalUsers = User::where('id', '!=', $user->id)->count();


        $pokemonIds = $users->pluck('picks')
            ->flatten(1)
            ->pluck('pokemon_id')
            ->unique()
            ->toArray();

        $pokemons = $adaptor->getById($pokemonIds);

        return response()->json([
            'trainers'      => new UserCollection($users),
            'totalTrainers' => $totalUsers,
            'pokemons'      => new PokemonCollection($pokemons),
        ]);
    }

    /**
     * @param StoreUserRequest $request
     * @param CreateUserService $service
     * @return JsonResponse
     */
    public function store(
        StoreUserRequest  $request,
        CreateUserService $service
    ): JsonResponse
    {
        $service->handle($request);

        return response()->json(['message' => 'User has been created.']);
    }

    /**
     * @param UpdateUserRequest $request
     * @param UpdateUserService $service
     * @return JsonResponse
     * @throws EmailTakenException
     * @throws ErrorException
     */
    public function update(
        UpdateUserRequest $request,
        UpdateUserService $service
    ): JsonResponse
    {
        $isUpdated = $service->handle($request);

        if (!$isUpdated) {
            throw new ErrorException('An error occurred while trying to update the profile');
        }

        return response()->json(['message' => 'Successfully updated the profile information']);
    }

}
