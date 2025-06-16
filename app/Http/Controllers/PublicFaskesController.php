<?php

namespace App\Http\Controllers;

use App\Models\Faskes; // Impor model Faskes
use App\Models\Provinsi; // Impor model Provinsi
use App\Models\JenisFaskes; // Impor model JenisFaskes
use App\Models\Kabkota; // Pastikan ini diimpor jika model Kabkota digunakan
use Illuminate\Http\Request;
use Illuminate\View\View; // <<< TAMBAHKAN INI UNTUK TYPE HINTING

class PublicFaskesController extends Controller
{
    // Method untuk halaman daftar faskes (ini yang menampilkan landing.blade.php)
    public function index(Request $request): View // <<< TAMBAHKAN ': View' untuk type hinting
    {
        $query = Faskes::with(['kabkota.provinsi', 'jenisFaskes', 'kategori']);

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('alamat', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('provinsi_id')) {
            $query->whereHas('kabkota.provinsi', function ($q) use ($request) {
                $q->where('id', $request->provinsi_id);
            });
        }

        if ($request->filled('jenis_faskes_id')) {
            $query->where('jenis_faskes_id', $request->jenis_faskes_id);
        }

        $faskes = $query->paginate(9)->withQueryString();
        $provinsis = Provinsi::all();
        $jenisFaskes = JenisFaskes::all();

        // --- BAGIAN INI DITAMBAHKAN UNTUK PETA ---
        // Anda bisa mendapatkan URL ini dari Google Maps.
        // Contoh: Cari "Fasilitas Kesehatan Depok" di Google Maps, lalu klik "Share" -> "Embed a map"
        // Salin URL dari atribut 'src' iframe yang diberikan Google Maps.
        // URL ini akan menampilkan peta umum untuk area Depok.
        $mapUrl = "https://www.google.com/maps/embed/v1/place?key=YOUR_Maps_API_KEY&q="; // <<< GANTI DENGAN URL PETA SPESIFIK ANDA

        // Meneruskan variabel $mapUrl ke view
        return view('landing', compact('faskes', 'provinsis', 'jenisFaskes', 'mapUrl'));
    }

    // Method baru untuk halaman informasi umum website (welcome_info.blade.php)
    public function welcome(): View // <<< TAMBAHKAN METHOD INI
    {
        return view('welcome_info'); // Merender view welcome_info.blade.php
    }

    // Metode untuk detail faskes (opsional, jika Anda mengaktifkan rutenya)
    public function show(Faskes $faskes): View // <<< TAMBAHKAN ': View' untuk type hinting
    {
        $faskes->load(['kabkota.provinsi', 'jenisFaskes', 'kategori']);
        return view('faskes_detail', compact('faskes'));
    }
}