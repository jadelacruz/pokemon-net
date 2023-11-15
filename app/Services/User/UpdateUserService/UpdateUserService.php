<?php

namespace App\Services\User\UpdateUserService;

use App\Exceptions\User\EmailTakenException;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

/**
 * class UpdateUserService
 * @package App\Services\User\UpdateUserService
 */
class UpdateUserService
{
    /**
     * @param UpdateUserRequest $request
     * @return bool
     * @throws EmailTakenException
     */
    public function handle(UpdateUserRequest $request): bool
    {
        $user = $request->user('sanctum');
        $emailIsTaken = (bool)User::whereEmail($request->getEmail())
            ->where('id', '!=', $user->id)
            ->count();

        if ($emailIsTaken) {
            throw new EmailTakenException();
        }

        $user->first_name = $request->getFirstName();
        $user->last_name  = $request->getLastName();
        $user->email      = $request->getEmail();

        return $user->save();
    }
}
