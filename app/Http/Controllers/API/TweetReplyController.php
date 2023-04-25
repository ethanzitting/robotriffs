<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TweetReplyController extends Controller
{
    public function index(Request $request, Tweet $tweet): AnonymousResourceCollection
    {
        $replies = Tweet::query()
            ->where('parent_id', $tweet->id)
            ->withCount(['children', 'likes'])
            ->with([
                'user.avatar',
                'parent.user',
                'children',
                'likes',
                'image',
            ])
            ->orderByDesc('created_at')
            ->get();

        return TweetResource::collection($replies);
    }
}
