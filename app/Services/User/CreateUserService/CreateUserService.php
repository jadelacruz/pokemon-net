<?php

namespace App\Services\User\CreateUserService;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;

/**
 * class CreateUserService
 * @package App\Services\User\CreateUserService
 */
class CreateUserService
{
    /**
     * @param UserStoreRequest $request
     * @return User
     */
    public function handle(UserStoreRequest $request): User
    {
        return User::createRecord(
            name:     $request->getName(),
            username: $request->getUsername(),
            password: $request->getPassword()
        );
    }
}
