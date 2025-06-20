<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicFaskesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| dimuat oleh RouteServiceProvider dalam grup yang berisi middleware "web".
| Sekarang buatlah sesuatu yang hebat!
|
*/

// RUTE UTAMA: HALAMAN INFORMASI WEBSITE (PUBLIK, SEBELUM LOGIN)
Route::get('/', [PublicFaskesController::class, 'welcome'])->name('welcome');

// RUTE UNTUK HALAMAN FASILITAS KESEHATAN (MEMBUTUHKAN LOGIN)
Route::middleware('auth')->group(function () {
    // Halaman daftar faskes (di /faskes)
    Route::get('/faskes', [PublicFaskesController::class, 'index'])->name('faskes.index');

    // Fungsionalitas pencarian/filter di halaman daftar faskes
    Route::get('/faskes/search', [PublicFaskesController::class, 'index'])->name('faskes.search');

    // Halaman detail faskes
    Route::get('/faskes/{faskes}', [PublicFaskesController::class, 'show'])->name('faskes.show');
});

// RUTE DASHBOARD SETELAH LOGIN (UNTUK PENGGUNA DAN ADMIN)
// Rute ini akan diakses setelah pengguna berhasil login.
Route::get('/dashboard', function () {
    // PENTING: Sekarang memeriksa role 'admin' ATAU 'super_admin'
    if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')) { // <<< BARIS INI TELAH DIKOREKSI
        // Jika peran adalah 'admin' atau 'super_admin', arahkan ke dashboard panel admin Filament.
        return redirect()->route('filament.admin.pages.dashboard');
    }
    // Jika peran bukan 'admin' atau 'super_admin' (misal: 'user' biasa), arahkan ke halaman daftar faskes (/faskes)
    return redirect()->route('faskes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTE UNTUK MANAJEMEN PROFIL PENGGUNA (DARI LARAVEL BREEZE)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php'; 