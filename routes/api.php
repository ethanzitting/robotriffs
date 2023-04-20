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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'users' => \App\Http\Controllers\API\UserController::class,
        'user-follows' => \App\Http\Controllers\API\UserFollowController::class,
        'likes' => \App\Http\Controllers\API\LikeController::class,
        'tweets' => \App\Http\Controllers\API\TweetController::class,
    ]);
});

