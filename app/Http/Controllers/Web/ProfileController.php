<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Image;
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
                'avatars',
                'banners',
            ])
            ->withCount([
                'tweets',
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
            'user' => new UserResource($user),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->name) {
            $user->name = $request->name;
            $user->save();
        }

        if ($request->bio) {
            $user->profile->bio = $request->bio;
            $user->profile->save();
        }

        if (isset($request->avatar)) {
            $image = Image::make();
            $image->user_id = Auth::user()->id;
            $image->type = 'avatar';
            $image->save();
            $image->fresh();
            $image->file_name = $image->id.'.'.$request->avatar->extension();
            $image->save();

            $request->file('avatar')
                ->storeAs('public/tweets', $image->file_name);
        }

        return redirect()->to(route('user.profile', ['slug' => $user->handle]));
    }
}
