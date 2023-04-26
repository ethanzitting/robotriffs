<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TweetPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(): bool
    {
        return false;
    }

    public function view(): bool
    {
        return false;
    }

    public function create(): bool
    {
        return false;
    }

    public function update(): bool
    {
        return false;
    }

    public function delete(User $user, Tweet $tweet): bool
    {
        return $tweet->user_id === $user->id;
    }

}
