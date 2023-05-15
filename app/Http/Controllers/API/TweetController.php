<?php

namespace App\Http\Controllers\API;

use App\Events\ReplyPosted;
use App\Events\TweetPosted;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\Image;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $tweets = Tweet::query()
            ->where('user_id', $request->user)
            ->withCount(['children', 'likes'])
            ->with([
                'user.avatar',
                'parent.user',
                'children',
                'image',
                'likes',
            ])
            ->orderByDesc('created_at')
            ->get();

        return TweetResource::collection($tweets);
    }

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

        if ($tweet->parent_id) {
            event (new ReplyPosted($tweet->user_id, $tweet->id));
        }

        return new TweetResource($tweet);
    }

    public function destroy(Request $request, Tweet $tweet): JsonResponse
    {
        $this->authorize('delete', $tweet);

        $tweet->delete();

        return response()
            ->json([], 204);
    }
}
