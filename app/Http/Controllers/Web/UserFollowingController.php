<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFollowingController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $user = User::firstWhere('handle', $slug)
            ->load([
                'following.avatar',
                'following.profile',
                'following.followers',
            ]);

        return Inertia::render('Profile/Following', [
            'user' => UserResource::make($user),
        ]);
    }
}
