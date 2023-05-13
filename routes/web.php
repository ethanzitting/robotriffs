<?php

use App\Http\Controllers\Web\DirectoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SettingsController;
use App\Http\Controllers\Web\TweetController;
use App\Http\Controllers\Web\UserFollowerController;
use App\Http\Controllers\Web\UserFollowingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (!Auth::user()) {
        return Inertia::render('GuestFeed');
    }
    return (new HomeController())->index();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('settings', SettingsController::class)->name('user.settings');
    Route::get('directory', DirectoryController::class)->name('directory');
    Route::post('tweets', [TweetController::class, 'store']);
    Route::get('{slug}', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('{slug}/followers', [UserFollowerController::class, 'show'])->name('user.followers');
    Route::get('{slug}/following', [UserFollowingController::class, 'show'])->name('user.following');
    Route::get('/{slug}/tweet/{tweet}', [TweetController::class, 'show'])->name('user.tweet');
    Route::put('/profiles/{profile}', [ProfileController::class, 'update']);
});
