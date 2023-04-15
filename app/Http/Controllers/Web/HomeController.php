<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Services\TweetService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $userFeed = (new TweetService())->getFeedForUser(Auth::user());

        return Inertia::render('Home', [
            'tweets' => TweetResource::collection($userFeed),
        ]);
    }
}
