<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $user = User::join('profiles', 'profiles.user_id', 'users.id')
            ->where('profiles.slug', $slug)
            ->select('users.*')
            ->with(['profile', 'posts'])
            ->first();

        if(!$user)
        {
            return Inertia::render('404', [
                'slug' => $slug,
                'currentUser' => Auth::user()->load('profile')
            ]);
        }

        return Inertia::render('Profile/Show', [
            'user' => $user,
            'currentUser' => Auth::user()->load('profile')
        ]);
    }
}
