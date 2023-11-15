<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\User\CreateUserService\CreateUserService;
use Illuminate\Http\JsonResponse;

/**
 * class UserApiController
 * @package App\Http\Controllers\Api
 */
class UserApiController extends Controller
{
    /**
     * @param StoreUserRequest $request
     * @param CreateUserService $service
     * @return JsonResponse
     */
    public function store(
        StoreUserRequest  $request,
        CreateUserService $service
    ): JsonResponse
    {
        $service->handle($request);

        return response()->json(['message' => 'User has been created.']);
    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $user = auth()->guard('sanctum')->user();

        return response()->json(
            new UserResource($user)
        );
    }
}
