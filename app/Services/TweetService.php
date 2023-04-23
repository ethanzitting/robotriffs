<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Collection;

class TweetService
{
    public function getFeedForUser(?User $user): Collection
    {
        if (! $user) {
            return collect();
        }

        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

        return Tweet::whereIn('user_id', $followedByUser)
            ->withCount(['children', 'likes'])
            ->with([
                'user.avatars',
                'likes',
                'image',
                'children',
                'parent.user',
            ])
            ->orderByDesc('created_at')
            ->get();
    }
}
