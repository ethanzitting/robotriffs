<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserFollowerController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $user = User::firstWhere('handle', $slug)
            ->load([
                'followers.avatar',
                'followers.profile',
                'followers.followers',
            ]);

        return Inertia::render('Profile/Followers', [
            'user' => UserResource::make($user),
        ]);
    }
}
