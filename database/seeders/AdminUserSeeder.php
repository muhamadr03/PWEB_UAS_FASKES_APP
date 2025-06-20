<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // Membuat pengguna super admin
        if (User::where('email', 'superadmin@faskes.com')->doesntExist()) {
            User::create([
                'name' => 'Super Admin Faskes',
                'email' => 'superadmin@faskes.com',
                'password' => Hash::make('password'), // Password: 'password'
                'role' => User::ROLE_SUPER_ADMIN, // Menggunakan konstanta
            ]);
            $this->command->info('Pengguna Super Admin (superadmin@faskes.com) berhasil ditambahkan.');
        } else {
            $this->command->info('Pengguna Super Admin (superadmin@faskes.com) sudah ada.');
        }

        // Membuat pengguna admin
        if (User::where('email', 'admin@faskes.com')->doesntExist()) {
            User::create([
                'name' => 'Admin Faskes',
                'email' => 'admin@faskes.com',
                'password' => Hash::make('password'), // Password: 'password'
                'role' => User::ROLE_ADMIN, // Menggunakan konstanta
            ]);
            $this->command->info('Pengguna Admin (admin@faskes.com) berhasil ditambahkan.');
        } else {
            $this->command->info('Pengguna Admin (admin@faskes.com) sudah ada.');
        }

        // Membuat pengguna biasa
        if (User::where('email', 'user@faskes.com')->doesntExist()) {
            User::create([
                'name' => 'Pengguna Biasa',
                'email' => 'user@faskes.com',
                'password' => Hash::make('password'), // Password: 'password'
                'role' => User::ROLE_USER, // Menggunakan konstanta
            ]);
            $this->command->info('Pengguna Biasa (user@faskes.com) berhasil ditambahkan.');
        } else {
            $this->command->info('Pengguna Biasa (user@faskes.com) sudah ada.');
        }
    }
}