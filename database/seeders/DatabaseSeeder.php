<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun Admin
        User::create([
            'name'     => 'Admin Himpunan',
            'nim'      => null,
            'email'    => 'admin@himpunan.ac.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Buat akun Mahasiswa contoh
        User::create([
            'name'     => 'Budi Santoso',
            'nim'      => '2024001',
            'email'    => 'budi@mahasiswa.ac.id',
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);
    }
}
