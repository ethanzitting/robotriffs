<?php

namespace App\Http\Controllers\API;

use App\Events\TweetLiked;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request): LikeResource
    {
        $like = Like::make();
        $like->user_id = Auth::user()->id;
        $like->tweet_id = $request->tweet;
        $like->save();

        event(new TweetLiked($like->user_id, $like->tweet_id));

        return new LikeResource($like);
    }

    public function destroy(Request $request, Tweet $tweet): JsonResponse
    {
        $like = Like::where('user_id', Auth::user()->id)
            ->where('tweet_id', $request->tweet)
            ->first();

        $like->delete();

        return response()->json([], 204);
    }
}
