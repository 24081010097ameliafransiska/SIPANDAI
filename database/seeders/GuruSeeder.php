<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'warda@sipandai.test',
            ],
            [
                'name' => 'Bu Warda',
                'nisn' => null,
                'tanggal_lahir' => null,
                'password' => Hash::make('12345678'),
                'role' => 'guru',
            ]
        );

        User::firstOrCreate(
            [
                'email' => 'sugeng@sipandai.test',
            ],
            [
                'name' => 'Pak Sugeng',
                'nisn' => null,
                'tanggal_lahir' => null,
                'password' => Hash::make('12345678'),
                'role' => 'guru',
            ]
        );
    }
}