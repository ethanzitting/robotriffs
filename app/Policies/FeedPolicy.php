<?php

namespace App\Policies;

use App\Models\User;

class FeedPolicy
{
    public function view(User $currentUser, User $ownerOfFeed): bool
    {
        return $currentUser->id === $ownerOfFeed->id;
    }
}
