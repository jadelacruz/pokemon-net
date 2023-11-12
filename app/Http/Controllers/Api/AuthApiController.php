<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CheckAuthRequest;
use Illuminate\Http\JsonResponse;

/**
 * class AuthApiController
 * @package App\Http\Controllers\Api
 */
class AuthApiController
{
    /**
     * @param CheckAuthRequest $request
     * @return JsonResponse
     */
    public function auth(CheckAuthRequest $request): JsonResponse
    {
        $attempt = auth()->attempt([
            'username' => $request->getUsername(),
            'password' => $request->getPassword()
        ]);

        if ($attempt) return response()->json(['message' => 'Valid credentials']);

        return response()->json([
            'message' => 'Invalid credentials',
            'errors'  => [
                'username' => [],
                'password' => ['Invalid credentials']
            ]
        ], 401);
    }
}
