<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\Image;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function store(Request $request): TweetResource
    {
        $tweet = Tweet::make();
        $tweet->user_id = Auth::user()->id;
        $tweet->content = $request->tweetContent;
        $tweet->parent_id = $request->parentTweet;
        $tweet->save();
        $tweet->fresh();

        if (isset($request->image)) {
            $image = Image::make();
            $image->tweet_id = $tweet->id;
            $image->type = 'tweet';
            $image->save();
            $image->fresh();
            $image->file_name = $image->id.'.'.$request->image->extension();
            $image->save();

            $request->file('image')
                ->storeAs('public/tweets', $image->file_name);
        }

        return new TweetResource($tweet);
    }
}
