<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->hasPosts()
            ->hasProfile()
            ->create([
                'email' => 'dev@robotriffs.com',
                'name' => 'Ethan Zitting',
                'handle' => 'ethanzitting',
                'password' => Hash::make('admin'),
            ]);

        User::factory(10)
            ->hasProfile()
            ->hasPosts(3)
            ->create();
    }
}
