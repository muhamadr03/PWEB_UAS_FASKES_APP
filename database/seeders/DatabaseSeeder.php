<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create(); // Ini adalah contoh dari instalasi Laravel default, bisa dihapus atau diubah

        // Panggil seeder-seeder kustom Anda di sini
        $this->call([
            AdminUserSeeder::class,
            JenisFaskesSeeder::class,
            KategoriSeeder::class,
            // Tambahkan seeder lain jika Anda membuatnya, misal:
            ProvinsiSeeder::class,
            // KabkotaSeeder::class,
            // FaskesSeeder::class, // Jika Anda membuat faskes dummy
        ]);
    }
}