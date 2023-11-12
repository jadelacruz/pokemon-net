<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

/**
 * class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return Renderable
     */
    public function dashboard(): Renderable
    {
        return view('dashboard');
    }
}
