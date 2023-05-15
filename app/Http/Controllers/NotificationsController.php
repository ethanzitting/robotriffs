<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function __invoke()
    {
        $notifications = Notification::query()
            ->with([
                'causedBy.avatar',
                'tweet'
            ])
            ->where('user_id', Auth::user()->id)
            ->get();

        return Inertia::render('Notifications', [
            'notifications' => NotificationResource::collection($notifications)
        ]);
    }
}
