<?php

namespace App\Http\Controllers;

use App\Exceptions\Auth\InvalidAuthException;
use App\Http\Requests\CheckAuthRequest;
use App\Services\Auth\CheckAuthService\CheckAuthService;
use Illuminate\Http\RedirectResponse;

/**
 * class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param CheckAuthRequest $request
     * @param CheckAuthService $service
     * @return RedirectResponse
     * @throws InvalidAuthException
     */
    public function auth(
        CheckAuthRequest $request,
        CheckAuthService $service
    ): RedirectResponse
    {
        $isCredentialsValid = $service->handle($request);

        if ($isCredentialsValid) {
            $jwtToken = $request->user()
                ->createToken('jwt-token');
            $sessionManager = $request->session();
            $sessionManager->regenerate();
            $sessionManager->put('jwtToken', $jwtToken->plainTextToken);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['message' => 'Invalid credentials']);
    }

    /**
     * @return RedirectResponse
     */
    public function signOut(): RedirectResponse
    {
        session()->flush();

        return redirect()->intended('login');

    }
}
