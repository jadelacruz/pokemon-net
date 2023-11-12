<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return Renderable|RedirectResponse
     */
    public function login(): Renderable|RedirectResponse
    {
        if (auth()->user()) return redirect()->intended('dashboard');

        return view('home');
    }
}
