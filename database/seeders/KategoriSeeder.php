<?php

namespace Database\Seeders;

use App\Models\Kategori; // Impor model Kategori Anda
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            ['nama' => 'Umum'],
            ['nama' => 'Anak'],
            ['nama' => 'Gigi'],
            ['nama' => 'Mata'],
            ['nama' => 'Bedah'],
            ['nama' => 'Farmasi'],
        ];

        foreach ($kategoriData as $data) {
            Kategori::firstOrCreate(['nama' => $data['nama']], $data);
        }

        $this->command->info('Kategori berhasil ditambahkan!');
    }
}