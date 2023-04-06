<?php

namespace App\Services;

use App\Models\Tweet;
use Illuminate\Contracts\Auth\Authenticatable;

class TweetService {

    public function getFeedForUser(?Authenticatable $user)
    {
        if (!$user) {
            return [];
        }

        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

        return Tweet::whereIn('user_id', $followedByUser)
            ->with(['user', 'user.avatars'])
            ->orderByDesc('created_at')
            ->get();
    }
}
