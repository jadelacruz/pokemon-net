<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserPickRequest;
use App\Http\Resources\UserPickCollection;
use App\Services\UserPick\CreateUserPickService;
use App\Services\UserPick\ListUserPickService;
use Illuminate\Http\JsonResponse;

/**
 * class UserPickApiController
 * @package App\Http\Controllers\Api
 */
class UserPickApiController
{
    /**
     * @param ListUserPickService $service
     * @return JsonResponse
     */
    public function list(
        ListUserPickService $service
    )
    {
        $list = $service->handle(request()->user('sanctum'));

        return response()->json(
            new UserPickCollection($list)
        );
    }

    /**
     * @param StoreUserPickRequest $request
     * @param CreateUserPickService $service
     * @return JsonResponse
     */
    public function store(
        StoreUserPickRequest $request,
        CreateUserPickService $service
    ): JsonResponse
    {
        $userPicks = $service->handle($request);

        return response()->json(
            new UserPickCollection($userPicks)
        );
    }
}
