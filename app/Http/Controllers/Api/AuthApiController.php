<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Auth\InvalidAuthException;
use App\Http\Requests\CheckAuthRequest;
use App\Services\Auth\CheckAuthService\CheckAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Session\SessionManager;

/**
 * class AuthApiController
 * @package App\Http\Controllers\Api
 */
class AuthApiController
{
    /**
     * @param CheckAuthRequest $request
     * @param CheckAuthService $service
     * @return JsonResponse
     */
    public function auth(
        CheckAuthRequest $request,
        CheckAuthService $service
    ): JsonResponse
    {
        try {
            $service->handle($request);
        } catch (InvalidAuthException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors'  => [
                    'username' => [],
                    'password' => [ $e->getMessage() ]
                ]
            ], 401);
        }

        return response()->json(['message' => 'Valid credentials']);
    }

    /**
     * @return JsonResponse
     */
    public function signOut(): JsonResponse
    {
        $loggedOut = request()->user()->currentAccessToken()->delete();

        if (!$loggedOut) {
            return response()->json(['message' => 'An error occurred while trying to delete the token'], 500);
        }

        return response()->json(['message' => 'SPA token deleted']);
    }
}
