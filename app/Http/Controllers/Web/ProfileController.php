<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request, string $slug)
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
            'user' => new UserResource($user),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->save();

        $user->profile->bio = $request->bio;
        $user->profile->save();

        return redirect()->to(route('user.profile', ['slug' => $user->handle]));
    }
}
