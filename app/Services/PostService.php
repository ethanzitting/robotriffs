<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;

class PostService {

    public function getFeedForUser(?Authenticatable $user)
    {
        if (!$user) {
            return [];
        }

        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

        return Post::whereIn('user_id', $followedByUser)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }
}
