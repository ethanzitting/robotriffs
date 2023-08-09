<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TweetService extends BaseService
{
    public static function getGuestFeedQuery(): Builder
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
            ->orderByDesc('created_at');
    }

    public function getFeedQueryForUser(User $user): Builder
    {
        $followedByUser = $user->following->pluck('id')
            ->push($user->id);

        if ($followedByUser->isEmpty()) {
            return TweetService::getGuestFeedQuery();
        }

        User::query()
            ->where('handle', 'robot')
            ->delete();

        return Tweet::whereIn('user_id', $followedByUser)
            ->withCount(['children', 'likes'])
            ->with([
                'user.avatar',
                'likes',
                'image',
                'children',
                'parent.user',
            ])
            ->orderByDesc('created_at');
    }
}
