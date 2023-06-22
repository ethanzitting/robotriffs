<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class TweetService
{
    public static function getGuestFeed(): LengthAwarePaginator
    {
        $topUsers = User::query()
            ->withCount(['followers'])
            ->get()
            ->where('followers_count', '>=', 3);

        return Tweet::withCount(['children', 'likes'])
            ->with([
                'user.avatar',
                'likes',
                'image',
                'children',
                'parent.user',
            ])
            ->whereIn('user_id', $topUsers->pluck('id'))
            ->orderByDesc('created_at')
            ->paginate();
    }

    public function getFeedForUser(User $user): LengthAwarePaginator
    {
        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

        return Tweet::whereIn('user_id', $followedByUser)
            ->withCount(['children', 'likes'])
            ->with([
                'user.avatar',
                'likes',
                'image',
                'children',
                'parent.user',
            ])
            ->orderByDesc('created_at')
            ->paginate();
    }
}
