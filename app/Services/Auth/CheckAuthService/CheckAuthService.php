<?php

namespace App\Services\Auth\CheckAuthService;

use App\Exceptions\Auth\InvalidAuthException;
use App\Http\Requests\CheckAuthRequest;
use Illuminate\Session\SessionManager;

/**
 * class CheckAuthService
 * @package App\Services\Auth\CheckAuthenticationService
 */
class CheckAuthService
{
    /**
     * @param CheckAuthRequest $request
     * @return bool
     * @throws InvalidAuthException
     */
    public function handle(CheckAuthRequest $request): bool
    {
        $authenticated = auth()->attempt([
            'email'    => $request->getEmail(),
            'password' => $request->getPassword()
        ]);

        if (!$authenticated) {
            throw new InvalidAuthException();
        }

        return $authenticated;
    }
}
