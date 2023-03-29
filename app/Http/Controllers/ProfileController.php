<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $profile = Profile::where('slug', $slug)->with('user')->first();
        if(!$profile)
        {
            return Inertia::render('Bar', [
                'slug' => $slug,
            ]);
        }

        return Inertia::render('profile.show', [
            'profile' => $profile,
        ]);
    }
}
