<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAuthRequest;
use Illuminate\Http\RedirectResponse;

/**
 * class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    /**
     * @param CheckAuthRequest $request
     * @return RedirectResponse
     */
    public function auth(CheckAuthRequest $request): RedirectResponse
    {
        $attempt = auth()->attempt([
            'username' => $request->getUsername(),
            'password' => $request->getPassword()
        ]);

        if ($attempt) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['message' => 'Invalid credentials']);
    }
}
