<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexFeedRequest;
use App\Http\Resources\TweetResource;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FeedController extends Controller
{
    public function index(IndexFeedRequest $request): AnonymousResourceCollection
    {
        $this->authorize('view-feed', User::find($request->user));

        $tweetQuery = (new TweetService())
            ->getFeedQueryForUser(User::find($request->user));

        return TweetResource::collection($tweetQuery->paginate());
    }
}
