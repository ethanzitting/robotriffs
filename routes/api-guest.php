<?php

use App\Http\Resources\TweetResource;
use App\Services\TweetService;
use Illuminate\Support\Facades\Route;

Route::get(
    '/guest-feed',
    fn () => TweetResource::collection(TweetService::getGuestFeedQuery()->paginate())
);
