<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TweetController extends Controller
{
    public function __invoke(
        Request $request,
        string $slug,
        string $tweet
    ): Response {
        return Inertia::render('Tweet', [
            'tweet' => Tweet::findOrFail($tweet)
        ]);
    }
}
