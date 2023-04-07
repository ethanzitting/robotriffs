<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Account/Show', [
            'sessions' => [],
            'confirmsTwoFactorAuthentication' => false,
        ]);
    }
}
