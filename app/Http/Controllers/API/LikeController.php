<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request): LikeResource
    {
        $like = Like::make();
        $like->user_id = $request->user;
        $like->tweet_id = $request->tweet;
        $like->save();

        return new LikeResource($like);
    }

    public function destroy(Request $request, Tweet $tweet): JsonResponse
    {
        $like = Like::where('user_id', $request->user)
            ->where('tweet_id', $request->tweet)
            ->first();

        $like->delete();

        return response()->json([], 204);
    }
}
