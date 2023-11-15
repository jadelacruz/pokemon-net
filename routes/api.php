<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\UserPickApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PokemonApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth', [AuthApiController::class, 'auth']);
Route::post('user', [UserApiController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserApiController::class, 'show']);

    Route::prefix('user/pick')->group(function () {
        Route::get('/', [UserPickApiController::class, 'list']);
        Route::post('/', [UserPickApiController::class, 'store']);
    });


    Route::get('pokemon', [PokemonApiController::class, 'list']);
    Route::post('logout', [AuthApiController::class, 'signOut']);
});


