<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
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
            ->hasTweets()
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasProfile()
            ->create([
                'email' => 'dev@robotriffs.com',
                'name' => 'Ethan Zitting',
                'handle' => 'ethanzitting',
                'password' => Hash::make('admin'),
            ]);

        User::factory(10)
            ->hasProfile()
            ->has(Image::factory()->avatar())
            ->has(Image::factory()->banner())
            ->hasTweets(3)
            ->create();
    }
}
