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

Route::get('tweets', [\App\Http\Controllers\API\TweetController::class, 'index']);
Route::get('tweets/{tweet}/replies', [\App\Http\Controllers\API\TweetReplyController::class, 'index']);
Route::get('user-follows', [\App\Http\Controllers\API\UserFollowController::class, 'index']);
Route::get('users', [\App\Http\Controllers\API\UserController::class, 'index']);
Route::get('users/{user}', [\App\Http\Controllers\API\UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('tweets', [\App\Http\Controllers\API\TweetController::class, 'store']);
    Route::delete('tweets/{tweet}', [\App\Http\Controllers\API\TweetController::class, 'destroy']);
    Route::post('user-follows', [\App\Http\Controllers\API\UserFollowController::class, 'store']);
    Route::delete('user-follows/{followed}', [\App\Http\Controllers\API\UserFollowController::class, 'destroy']);

    Route::apiResources([
        'likes' => \App\Http\Controllers\API\LikeController::class,
        'images' => \App\Http\Controllers\API\ImageController::class,
        'feeds' => \App\Http\Controllers\API\FeedController::class,
        'notifications' => \App\Http\Controllers\API\NotificationController::class,
    ]);
});
