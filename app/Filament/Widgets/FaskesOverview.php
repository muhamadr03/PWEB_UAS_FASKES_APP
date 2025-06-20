<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget; // Ini adalah kelas dasar untuk widget statistik
use Filament\Widgets\StatsOverviewWidget\Stat; // Ini adalah kelas untuk setiap item statistik individual

// Impor semua model yang datanya ingin Anda hitung
use App\Models\Faskes;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabkota;
use App\Models\JenisFaskes;
use App\Models\Kategori;

class FaskesOverview extends BaseWidget
{
    // Properti statis ini menentukan urutan widget di dashboard jika ada lebih dari satu
    protected static ?int $sort = 0;

    /**
     * Metode ini mengembalikan array dari objek Stat.
     * Setiap objek Stat merepresentasikan satu kartu statistik di dashboard.
     */
    protected function getStats(): array
    {
        return [
            Stat::make('Total Fasilitas Kesehatan', Faskes::count()) // Hitung total faskes
                ->description('Jumlah seluruh faskes terdata') // Deskripsi di bawah judul
                ->descriptionIcon('heroicon-s-building-library') // Ikon deskripsi (dari Heroicons Solid)
                ->color('primary') // Warna tema kartu (menggunakan palet Filament)
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Contoh data dummy untuk mini-chart

            Stat::make('Total Pengguna Terdaftar', User::count()) // Hitung total user
                ->description('Jumlah seluruh pengguna')
                ->descriptionIcon('heroicon-s-users')
                ->color('success')
                ->chart([1, 5, 2, 7, 3, 8, 4]),

            Stat::make('Total Provinsi', Provinsi::count()) // Hitung total provinsi
                ->description('Jumlah provinsi yang terdata')
                ->descriptionIcon('heroicon-s-map')
                ->color('info')
                ->chart([5, 8, 12, 10, 14, 16, 18]),

            Stat::make('Total Kabupaten/Kota', Kabkota::count()) // Hitung total kabupaten/kota
                ->description('Jumlah kabupaten/kota yang terdata')
                ->descriptionIcon('heroicon-s-building-office-2')
                ->color('warning'),

            Stat::make('Total Jenis Faskes', JenisFaskes::count()) // Hitung total jenis faskes
                ->description('Jumlah jenis faskes yang terdata')
                ->descriptionIcon('heroicon-s-tag')
                ->color('danger'),

            Stat::make('Total Kategori Faskes', Kategori::count()) // Hitung total kategori faskes
                ->description('Jumlah kategori faskes yang terdata')
                ->descriptionIcon('heroicon-s-list-bullet')
                ->color('gray'),
        ];
    }
}