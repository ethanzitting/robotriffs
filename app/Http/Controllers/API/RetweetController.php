<?php

namespace App\Http\Controllers\API;

use App\Models\Retweet;
use App\Models\Tweet;
use Illuminate\Http\Request;

class RetweetController
{
    public function store(Request $request)
    {
        $retweet = Retweet::make();
        $retweet->user_id = $request->user;
        $retweet->tweet_id = $request->tweet;
        $retweet->save();

        return $retweet;
    }

    public function destroy(Request $request, Retweet $retweet)
    {

        $retweet->delete();

        return response()->json([], 204);
    }
}