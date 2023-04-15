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
                Tweet::factory(30)
                    ->hasLikes(2)
                    ->hasChildren(2)
                    ->hasImage()
            )
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasFollowers(2)
            ->hasFollowing(3)
            ->create([
                'email' => 'dev@robotriffs.com',
                'name' => 'Ethan Zitting',
                'handle' => 'ethanzitting',
                'password' => Hash::make('admin'),
            ]);

        User::factory(10)
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasTweets(3)
            ->create();
    }
}
