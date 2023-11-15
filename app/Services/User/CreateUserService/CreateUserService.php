<?php

namespace App\Services\User\CreateUserService;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

/**
 * class CreateUserService
 * @package App\Services\User\CreateUserService
 */
class CreateUserService
{
    /**
     * @param StoreUserRequest $request
     * @return User
     */
    public function handle(StoreUserRequest $request): User
    {
        return User::createRecord(
            firstName: $request->getFirstName(),
            lastName : $request->getLastName(),
            email    : $request->getEmail(),
            password : $request->getPassword()
        );
    }
}
