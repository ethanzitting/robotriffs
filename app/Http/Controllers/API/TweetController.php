<?php

namespace App\Http\Controllers\API;

use App\Events\ReplyPosted;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function __construct(protected ImageService $imageService)
    {
    }

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
            $this->imageService->saveImage(
                $request->file('image'),
                $request->image->extension(),
                $tweet->id,
            );

            $tweet->load('image');
        }

        if ($tweet->parent_id) {
            event(new ReplyPosted($tweet->user_id, $tweet->id));
        }

        return new TweetResource($tweet->load('image'));
    }

    public function destroy(Request $request, Tweet $tweet): JsonResponse
    {
        $this->authorize('delete', $tweet);

        $tweet->delete();

        return response()
            ->json([], 204);
    }
}
