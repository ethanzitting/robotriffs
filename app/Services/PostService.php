<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class PostService {

    public function getFeedForUser(?Authenticatable $user)
    {
        if (!$user) {
            return [];
        }

        // TODO:
        $followedByUser = User::all()->pluck('id');

        return Post::whereIn('user_id', $followedByUser)
            ->with('user')
            ->get();
    }
}
