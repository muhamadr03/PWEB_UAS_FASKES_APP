<?php

namespace Database\Seeders;

use App\Models\JenisFaskes; // Impor model JenisFaskes Anda
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Jika ingin menggunakan Query Builder atau Raw SQL

class JenisFaskesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data yang ada dulu (opsional, hati-hati di produksi!)
        // DB::table('jenis_faskes')->truncate(); // Untuk membersihkan tabel sebelum mengisi
        // Atau JenisFaskes::truncate();

        $jenisFaskesData = [
            ['nama' => 'Rumah Sakit'],
            ['nama' => 'Puskesmas'],
            ['nama' => 'Klinik'],
            ['nama' => 'Apotek'],
            ['nama' => 'Laboratorium'],
        ];

        foreach ($jenisFaskesData as $data) {
            // Gunakan firstOrCreate untuk menghindari duplikasi berdasarkan nama
            JenisFaskes::firstOrCreate(['nama' => $data['nama']], $data);
        }

        // Atau bisa juga menggunakan insert jika data statis dan banyak
        // JenisFaskes::insert($jenisFaskesData);

        $this->command->info('Jenis Faskes berhasil ditambahkan!');
    }
}