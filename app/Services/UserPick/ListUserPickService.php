<?php

namespace App\Services\UserPick;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * class ListUserPickService
 * @package App\Services\UserPick
 */
class ListUserPickService
{
    /**
     * @param User $user
     * @return Collection
     */
    public function handle(User $user): Collection
    {
        return $user->picks;
    }
}
