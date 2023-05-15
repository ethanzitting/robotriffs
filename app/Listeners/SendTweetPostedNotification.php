<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\NotificationService;

class SendTweetPostedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(private NotificationService $notificationService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $followers = User::findOrFail($event->user)->followers;

        $followers->each(fn ($follower) => $this->notificationService
            ->createTweetPostedNotification(
                $follower->id,
                $event->user,
                $event->tweet
            ));
    }
}
