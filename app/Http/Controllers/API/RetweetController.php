<?php

namespace App\Http\Controllers\API;

use App\Models\Retweet;
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

    public function destroy(Request $request)
    {

        $retweet->delete();

        return response()->json([], 204);
    }
}
