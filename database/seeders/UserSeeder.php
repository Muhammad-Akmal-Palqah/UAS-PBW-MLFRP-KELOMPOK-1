<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jabatan; // Tambahkan ini
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat data Jabatan dulu agar ID 1 tersedia
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Super Admin',
            'deskripsi' => 'Pemegang kekuasaan penuh sistem'
        ]);

        // 2. Baru buat Usernya
        $user = User::create([
            'name' => 'Admin Lab',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password123'),
            'jabatan_id' => $jabatan->id, // Mengambil ID dari jabatan yang baru dibuat di atas
        ]);

        // 3. Berikan Role Spatie
        $user->assignRole('super-admin');
    }
}