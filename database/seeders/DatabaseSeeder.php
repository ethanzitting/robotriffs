<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(
                Tweet::factory(3)
                    ->hasLikes(2)
                    ->hasChildren(2)
                    ->hasImage()
            )
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasFollowers(2)
            ->hasFollowing(3)
            ->create([
                'email' => env('ADMIN_USER_EMAIL'),
                'name' => 'Mr Robot',
                'handle' => 'mrrobot',
                'password' => Hash::make(env('ADMIN_USER_PASSWORD')),
            ]);

        User::factory(2)
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasTweets(3)
            ->create();
    }
}
