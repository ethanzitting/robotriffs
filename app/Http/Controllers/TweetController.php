<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        $tweet = Tweet::make();
        $tweet->user_id = Auth::user()->id;
        $tweet->content = $request->tweetContent;
        $tweet->save();
    }
}
