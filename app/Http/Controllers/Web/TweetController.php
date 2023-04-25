<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TweetController extends Controller
{
    public function show(
        Request $request,
        string $slug,
        string $tweet
    ): Response {
        $tweet = Tweet::findOrFail($tweet)->load([
            'likes',
            'image',
            'user.avatar',
            'parent.user',
            'children.user',
            'children.likes',
            'children.image',
            'children.children',
        ]);

        return Inertia::render('Tweet', [
            'tweet' => new TweetResource($tweet),
            'user' =>  UserResource::make(Auth::user()->load(['avatar']))
        ]);
    }

    public function store(Request $request)
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

        return redirect()->back()->with('success', 'some message');
    }
}
