<?php

namespace App\Services;

use App\Events\NotificationCreated;
use App\Models\Notification;
use App\Types\NotificationTypes;

class NotificationService
{
    public function createTweetLikedNotification(
        int $userFor,
        int $causedBy,
        int $tweetId,
        string $createdAt = null,
        string $updatedAt = null,
    ): void {
        $this->createNotification(
            'tweetLiked',
            $userFor,
            $causedBy,
            tweetId: $tweetId,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    public function createUserFollowedNotification(
        int $userFor,
        int $causedBy,
        string $createdAt = null,
        string $updatedAt = null,
    ): void {
        $this->createNotification(
            'userFollowed',
            $userFor,
            $causedBy,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    public function createReplyPostedNotification(
        int $userFor,
        int $causedBy,
        int $tweetId,
        string $createdAt = null,
        string $updatedAt = null,
    ): void {
        $this->createNotification(
            'replyPosted',
            $userFor,
            $causedBy,
            tweetId: $tweetId,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    public function createNotification(
        string $type,
        int $userFor,
        int $causedBy,
        int $tweetId = null,
        string $createdAt = null,
        string $updatedAt = null,
    ): void {
        $notification = new Notification();
        $notification->type = NotificationTypes::fromString($type);
        $notification->user_id = $userFor;
        $notification->tweet_id = $tweetId;
        $notification->caused_by = $causedBy;
        if ($createdAt) {
            $notification->created_at = $createdAt;
        }
        if ($updatedAt) {
            $notification->updated_at = $updatedAt;
        }
        $notification->save();

        broadcast(new NotificationCreated($notification));
    }
}
