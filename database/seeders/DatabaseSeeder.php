<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'nama' => 'Administrator BPS',
            'username' => 'admin',
            'email' => 'admin@bps.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'status' => 'Aktif',
        ]);

        // 2. Akun User (Pegawai Biasa)
        User::create([
            'nama' => 'Pegawai BPS',
            'username' => 'pegawai',
            'email' => 'pegawai@bps.go.id',
            'password' => Hash::make('pegawai123'),
            'role' => 'User',
            'status' => 'Aktif',
        ]);
    }
}