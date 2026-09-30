<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guru.sipandai@gmail.com'],
            [
                'name' => 'Guru SIPANDAI',
                'email' => 'guru.sipandai@gmail.com',
                'password' => Hash::make('smekaneda2026'),
                'role' => 'guru',
            ]
        );
    }
}