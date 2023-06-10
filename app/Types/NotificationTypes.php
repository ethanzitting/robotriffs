<?php

namespace App\Types;

use Illuminate\Support\Collection;

class NotificationTypes
{
    private function __construct()
    {
        // This only exists to prevent instantiation of this class.
    }

    /**
     * @deprecated
     */
    public const TWEET_POSTED = 3;

    public const TWEET_LIKED = 0;

    public const REPLY_CREATED = 2;

    public const USER_FOLLOWED = 4;

    private static function types(): Collection
    {
        return collect([
            static::TWEET_LIKED => 'tweetLiked',
            static::REPLY_CREATED => 'replyCreated',
            static::USER_FOLLOWED => 'userFollowed',
        ]);
    }

    public static function toString(int $value): string
    {
        return self::types()[$value];
    }

    public static function fromString(string $value): int
    {
        return self::types()->search($value);
    }
}
