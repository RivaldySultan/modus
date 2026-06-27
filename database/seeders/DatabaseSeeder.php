<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator BPS',
            'username' => 'admin',
            'email' => 'admin@bps.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'status' => 'Aktif',
        ]);
    }
}