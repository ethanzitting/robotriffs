<?php

namespace App\Listeners;

use App\Models\Tweet;
use App\Services\NotificationService;

class SendTweetLikedNotification
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
        $tweet = Tweet::findOrFail($event->tweet);

        (new NotificationService())
            ->createTweetLikedNotification(
                $tweet->user_id,
                $event->user,
                $tweet->id,
            );
    }
}
