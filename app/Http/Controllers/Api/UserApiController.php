<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Services\User\CreateUserService\CreateUserService;
use Illuminate\Http\JsonResponse;

/**
 * class UserApiController
 * @package App\Http\Controllers\Api
 */
class UserApiController extends Controller
{
    /**
     * @param UserStoreRequest $request
     * @param CreateUserService $service
     * @return JsonResponse
     */
    public function store(
        UserStoreRequest $request,
        CreateUserService $service
    ): JsonResponse
    {
        $service->handle($request);

        return response()->json(['message' => 'User has been created.']);
    }
}
