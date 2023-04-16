<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::resources([
    'follows' => \App\Http\Controllers\API\FollowController::class,
    'users' => \App\Http\Controllers\API\UserController::class,
    'likes' => \App\Http\Controllers\API\LikeController::class,
    'tweets' => \App\Http\Controllers\API\TweetController::class,
    'retweets' => \App\Http\Controllers\API\RetweetController::class,
]);

Route::delete('retweets/${retweet}');
