<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'testuser@gmail.com'],
            [
                'name' => 'Test User',
                'email' => 'testuser@gmail.com',
                'password' => Hash::make('demo123456'),
                'email_verified_at' => now(),
            ]
        );
    }

}
