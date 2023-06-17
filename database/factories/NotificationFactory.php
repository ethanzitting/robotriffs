<?php

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\User;
use App\Types\NotificationTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => NotificationTypes::TWEET_LIKED,
            'user_id' => User::factory(),
            'caused_by' => User::factory(),
            'tweet_id' => Tweet::factory(),
            'viewed' => false,
        ];
    }
}
