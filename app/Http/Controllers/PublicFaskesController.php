<?php

namespace App\Http\Controllers; // <<< PASTIKAN NAMESPACE INI BENAR

use App\Models\Faskes; // Impor model Faskes
use App\Models\Provinsi; // Impor model Provinsi
use App\Models\JenisFaskes; // Impor model JenisFaskes
use App\Models\Kabkota; // Impor model Kabkota
use Illuminate\Http\Request;

class PublicFaskesController extends Controller // <<< PASTIKAN NAMA KELAS INI BENAR
{
    public function index(Request $request)
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

        return view('landing', compact('faskes', 'provinsis', 'jenisFaskes'));
    }

    // Metode untuk detail faskes (opsional)
    public function show(Faskes $faskes)
    {
        $faskes->load(['kabkota.provinsi', 'jenisFaskes', 'kategori']);
        return view('faskes_detail', compact('faskes'));
    }
}