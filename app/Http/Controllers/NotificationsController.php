<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Notifications');
    }
}
