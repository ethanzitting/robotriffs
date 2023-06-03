<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::query()
            ->with([
                'causedBy.avatar',
                'tweet',
                'tweet.likes',
                'tweet.image',
                'tweet.user.avatar',
                'tweet.parent.user',
                'tweet.children.user',
                'tweet.children.likes',
                'tweet.children.image',
                'tweet.children.children',
            ])
            ->where('user_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Notifications', [
            'notifications' => NotificationResource::collection($notifications)
        ]);
    }
}
