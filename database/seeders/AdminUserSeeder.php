<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan user tidak duplikat sebelum membuat
        if (User::where('email', 'admin@faskes.com')->doesntExist()) {
            User::create([
                'name' => 'Admin Faskes',
                'email' => 'admin@faskes.com',
                'password' => Hash::make('password'), // Ganti dengan password kuat!
                'role' => 'admin',
            ]);
            $this->command->info('User admin berhasil ditambahkan.');
        } else {
            $this->command->info('User admin sudah ada.');
        }

        if (User::where('email', 'user@faskes.com')->doesntExist()) {
            User::create([
                'name' => 'User Biasa',
                'email' => 'user@faskes.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
            $this->command->info('User biasa berhasil ditambahkan.');
        } else {
            $this->command->info('User biasa sudah ada.');
        }
    }
}