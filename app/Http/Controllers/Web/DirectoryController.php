<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DirectoryController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Directory', [
            'users' => UserResource::collection(
                User::all()
                    ->load(['profile', 'avatar', 'followers'])
                    ->where('id', '!=', Auth::user()->id)
            ),
        ]);
    }
}
