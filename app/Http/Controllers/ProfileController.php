<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $user = User::where('handle', $slug)
            ->with([
                'profile',
                'tweets',
                'avatars',
                'banners',
                'following',
                'followers',
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
