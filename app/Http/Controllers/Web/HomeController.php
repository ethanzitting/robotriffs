<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Http\Resources\UserResource;
use App\Services\TweetService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $userFeed = (new TweetService())->getFeedForUser(Auth::user());

        return Inertia::render('Home', [
            'user' => UserResource::make(Auth::user()->load(['avatars'])),
            'tweets' => TweetResource::collection($userFeed),
        ]);
    }
}
