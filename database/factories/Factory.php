<?php

namespace Database\Factories;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;

class Factory extends BaseFactory
{
    public function definition(): array
    {
        return [
            "tweet_id" => Tweet::factory(),
            "user_id" => User::factory(),
        ];
    }
}
