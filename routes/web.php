<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Foundation\Application;
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
    Route::get('/home', function () {
        return Inertia::render('Home', [
            'tweets' => (new TweetService())->getFeedForUser(Auth::user()),
        ]);
    })->name('home');

    Route::get('/settings', function () {
        return Inertia::render('Account/Show', [
            'sessions' => [],
            'confirmsTwoFactorAuthentication' => false,
        ]);
    })->name('user.settings');

    Route::get('/directory', function () {
        return Inertia::render('Directory', [
            'users' => User::all(),
        ]);
    })->name('directory');

    Route::get('/{slug}', [ProfileController::class, 'show'])
        ->name('user.profile');
});

Route::resources([
    'profiles' => \App\Http\Controllers\ProfileController::class,
    'tweets' => \App\Http\Controllers\TweetController::class,
]);
