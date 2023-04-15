<?php

namespace App\Services;

use App\Models\Retweet;
use App\Models\Tweet;
use Illuminate\Contracts\Auth\Authenticatable;

class TweetService
{
    public function getFeedForUser(?Authenticatable $user)
    {
        if (! $user) {
            return [];
        }

        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

       $retweets = Retweet::whereIn('user_id', $followedByUser)
            ->with([
                'user',
                'tweet.user.avatars',
                'tweet.likes',
                'tweet.children',
                'tweet.parent.user',
            ])
            ->orderByDesc('created_at')
            ->get();

        $tweets = Tweet::whereIn('user_id', $followedByUser)
            ->with([
                'user.avatars',
                'likes',
                'children',
                'parent.user',
            ])
                ->orderByDesc('created_at')
                ->get();

        return [
            'retweets' => $retweets,
            'tweets' => $tweets,
        ];
    }
}
