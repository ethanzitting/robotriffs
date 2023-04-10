<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function __invoke(Request $request, string $slug)
    {
        $user = User::where('handle', $slug)
            ->with([
                'profile',
                'tweets.likes',
                'avatars',
                'banners',
                'following',
                'followers',
                'tweets.children',
                'tweets.parent.user',
            ])
            ->first();

        if (! $user) {
            return Inertia::render('404', [
                'slug' => $slug,
            ]);
        }

        return Inertia::render('Profile', [
            'user' => $user,
        ]);
    }
}
