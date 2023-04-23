<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FeedController extends Controller
{
    public function __construct(private TweetService $tweetService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $tweets = $this->tweetService
            ->getFeedForUser(User::findOrFail($request->user));

        return TweetResource::collection($tweets);
    }
}
