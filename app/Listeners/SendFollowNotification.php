<?php

namespace App\Listeners;

use App\Services\NotificationService;

class SendFollowNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        (new NotificationService())
            ->createUserFollowedNotification(
                $event->following,
                $event->follower,
            );
    }
}
