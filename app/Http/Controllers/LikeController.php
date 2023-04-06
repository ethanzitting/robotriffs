<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = Like::make();
        $like->user_id = $request->user;
        $like->tweet_id = $request->tweet;
        $like->save();
        return $like;
    }

    public function destroy(Request $request, Tweet $tweet)
    {
        $like = Like::where('user_id', $request->user)
            ->where('tweet_id', $request->tweet)
            ->first();

        $like->delete();

        return $like;
    }
}
