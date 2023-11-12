<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Auth\InvalidAuthException;
use App\Http\Requests\CheckAuthRequest;
use App\Services\Auth\CheckAuthService\CheckAuthService;
use Illuminate\Http\JsonResponse;

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
}
