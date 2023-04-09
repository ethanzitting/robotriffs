<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        $tweet = Tweet::make();
        $tweet->user_id = $request->userId;
        $tweet->content = $request->tweetContent;
        $tweet->parent_id = $request->parentTweet;
        $tweet->save();
    }
}
