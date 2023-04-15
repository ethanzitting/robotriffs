<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserFollowController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $followed = User::findOrFail($request->followed);

        return UserResource::collection($followed->followers);
    }

    public function store(Request $request): UserResource
    {
        $followed = User::findOrFail($request->followed);

        $followed
            ->followers()
            ->attach($request->follower);

        return new UserResource($followed);
    }

    public function destroy(Request $request): JsonResponse
    {
        $followed = User::findOrFail($request->followed);

        $followed
            ->followers()
            ->detach($request->follower);

        return response()->json([], 204);
    }
}
