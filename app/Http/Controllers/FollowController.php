<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function show(Request $request)
    {
        $follows = User::findOrFail($request->followed)
            ->followers->pluck('id')
            ->contains($request->follower);

        return response()->json(['follows' => $follows]);
    }

    public function store(Request $request)
    {
        $request->action === 'follow'
            ? User::findOrFail($request->followed)
                ->followers()->attach(User::findOrFail($request->follower))
            : User::findOrFail($request->followed)
                ->followers()->detach(User::findOrFail($request->follower));
    }
}
