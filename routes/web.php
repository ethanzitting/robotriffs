<?php

use App\Http\Controllers\Web\DirectoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SettingsController;
use App\Http\Controllers\Web\TweetController;
use Illuminate\Foundation\Application;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('home', HomeController::class)->name('home');
    Route::get('settings', SettingsController::class)->name('user.settings');
    Route::get('directory', DirectoryController::class)->name('directory');
    Route::post('tweets', [TweetController::class, 'store']);
    Route::get('{slug}', ProfileController::class)->name('user.profile');
    Route::get('/{slug}/tweet/{tweet}', [TweetController::class, 'show'])->name('user.tweet');
});
