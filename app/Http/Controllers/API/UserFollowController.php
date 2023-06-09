<?php

namespace App\Http\Controllers\API;

use App\Events\UserFollowed;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $followed = User::find($request->followed);

        return UserResource::collection($followed->followers);
    }

    public function store(Request $request): UserResource
    {
        $followed = User::findOrFail($request->followed);

        $followed
            ->followers()
            ->attach(Auth::user()->id);

        event(new UserFollowed($followed->id, Auth::user()->id));

        return new UserResource($followed);
    }

    public function destroy(Request $request): JsonResponse
    {
        $followed = User::findOrFail($request->followed);

        $followed
            ->followers()
            ->detach(Auth::user());

        return response()->json([], 204);
    }
}
