<?php

namespace App\Services\UserPick;

use App\Enums\UserPickTypeEnum;
use App\Exceptions\UserPick\MaximumUserPickWasReachedAlready;
use App\Http\Requests\StoreUserPickRequest;
use App\Models\User;
use App\Models\UserPick;
use Illuminate\Database\Eloquent\Collection;

/**
 * class CreateUserPickService
 * @package App\Services\UserPick
 */
class CreateUserPickService
{
    /** @var int  */
    const MAXIMUM_LIKE_AND_DISLIKE = 3;

    /**
     * @param StoreUserPickRequest $request
     * @return Collection
     * @throws MaximumUserPickWasReachedAlready
     */
    public function handle(StoreUserPickRequest $request): Collection
    {
        /** @var User $user */
        $user = $request->user('sanctum');

        /** @var Collection $userPickedPokemons */
        $userPickedPokemons = UserPick::whereUserId($user->id)->get();

        $samePick = $userPickedPokemons
            ->where('pick_type', $request->getPickType())
            ->where('pokemon_id', $request->getPokemonId())
            ->first();

        if (!empty($samePick)) {
            $samePick->delete();
        } else  {
            $this->checkMaxLikeDislike($userPickedPokemons, $request);
            UserPick::createRecord(
                user     : $user,
                pokemonId: $request->getPokemonId(),
                pickType : $request->getPickType()
            );
        }

        $this->handleCounterPick($userPickedPokemons, $request);
        return $this->getUserPicks($user);
    }

    /**
     * @param User $user
     * @return Collection
     */
    private function getUserPicks(User $user): Collection
    {
        return UserPick::whereUserId($user->id)
            ->get([
                'id',
                'pokemon_id',
                'pick_type'
            ]);
    }

    /**
     * @param Collection $userPickedPokemon
     * @param StoreUserPickRequest $request
     * @throws MaximumUserPickWasReachedAlready
     */
    private function checkMaxLikeDislike(
        Collection $userPickedPokemon,
        StoreUserPickRequest $request
    ): void
    {
        if ($request->getPickType() === UserPickTypeEnum::FAVORITE) return;

        $matchCount = $userPickedPokemon
            ->where('pick_type', $request->getPickType())
            ->count();

        if ($matchCount === self::MAXIMUM_LIKE_AND_DISLIKE) {
            $action = $request->getPickType()->value;
            throw new MaximumUserPickWasReachedAlready("You have reached maximum numbers of pokemon ${action}");
        }
    }

    /**
     * @param Collection $userPickedPokemon
     * @param StoreUserPickRequest $request
     */
    private function handleCounterPick(
        Collection $userPickedPokemon,
        StoreUserPickRequest $request
    ): void
    {
        $counterMap = [
            UserPickTypeEnum::LIKE->value    => UserPickTypeEnum::DISLIKE,
            UserPickTypeEnum::DISLIKE->value => UserPickTypeEnum::LIKE
        ];

        if ($request->getPickType() === UserPickTypeEnum::FAVORITE) return;

        $pickTypeValue = $request->getPickType()->value;
        $counterPick   = $userPickedPokemon
            ->where('pick_type', $counterMap[$pickTypeValue])
            ->first();

        if (!empty($counterPick)) {
            $counterPick->delete();
        }
    }

}
