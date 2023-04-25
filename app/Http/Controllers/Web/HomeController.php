<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home', [
            'user' => UserResource::make(Auth::user()->load(['avatar'])),
        ]);
    }
}
