<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = [
            [
                'name' => 'Amelia Fransiska',
                'nisn' => '0052147836',
                'tanggal_lahir' => '2005-01-12',
                'role' => 'siswa',
            ],
            [
                'name' => 'Rosita Eka Dwi Alzallva',
                'nisn' => '0056382914',
                'tanggal_lahir' => '2005-05-24',
                'role' => 'siswa',
            ],
            [
                'name' => 'Sofia Ramadhani Megantara',
                'nisn' => '0059274168',
                'tanggal_lahir' => '2005-09-08',
                'role' => 'siswa',
            ],
        ];

        foreach ($siswas as $siswa) {
            User::updateOrCreate(
                ['nisn' => $siswa['nisn']],
                $siswa
            );
        }
    }
}