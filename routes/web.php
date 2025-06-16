<?php

use App\Http\Controllers\ProfileController; // Diperlukan untuk fitur profil user (dari Breeze)
use App\Http\Controllers\PublicFaskesController; // <<< INI YANG PENTING UNTUK LANDING PAGE ANDA
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Diperlukan untuk mengecek status login dan role

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

// ========================================================================
// RUTE UTAMA UNTUK HALAMAN PUBLIK (LANDING PAGE FASILITAS KESEHATAN)
// ========================================================================
// Ketika pengguna mengakses URL dasar aplikasi (misal: http://127.0.0.1:8000/)
// Permintaan akan ditangani oleh metode 'index' di PublicFaskesController.
Route::get('/', [PublicFaskesController::class, 'index'])->name('faskes.index');

// Rute ini juga memanggil metode 'index' di PublicFaskesController.
// Digunakan untuk menangani permintaan pencarian dan filter dari landing page.
// Contoh: http://127.0.0.1:8000/faskes/search?keyword=rumah+sakit
Route::get('/faskes/search', [PublicFaskesController::class, 'index'])->name('faskes.search');

// (OPSIONAL) Rute untuk halaman detail satu fasilitas kesehatan.
// Jika Anda ingin membuat halaman yang menampilkan informasi lebih rinci tentang satu faskes.
// Aktifkan baris ini jika Anda membuat view faskes_detail.blade.php dan method show di PublicFaskesController.
Route::get('/faskes/{faskes}', [PublicFaskesController::class, 'show'])->name('faskes.show');


// ========================================================================
// RUTE DASHBOARD SETELAH LOGIN (UNTUK PENGGUNA DAN ADMIN)
// ========================================================================
// Rute ini akan diakses setelah pengguna berhasil login.
// Middleware 'auth' memastikan hanya pengguna yang sudah login yang bisa mengakses.
// Middleware 'verified' memastikan email pengguna sudah diverifikasi (jika diaktifkan di Breeze).
Route::get('/dashboard', function () {
    // Mengecek apakah pengguna yang login memiliki peran 'admin'.
    if (Auth::check() && Auth::user()->role === 'admin') {
        // Jika peran adalah 'admin', arahkan ke dashboard panel admin Filament.
        return redirect()->route('filament.admin.pages.dashboard');
    }
    // Jika peran bukan 'admin' (misal: 'user' biasa), arahkan ke dashboard bawaan Laravel Breeze.
    return redirect()->route('faskes.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// ========================================================================
// RUTE UNTUK MANAJEMEN PROFIL PENGGUNA (DARI LARAVEL BREEZE)
// ========================================================================
// Rute-rute ini berada dalam grup dengan middleware 'auth', artinya hanya
// pengguna yang sudah login yang bisa mengakses fitur profil.
Route::middleware('auth')->group(function () {
    // Menampilkan form edit profil.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Mengupdate data profil.
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Menghapus akun pengguna.
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ========================================================================
// MEMUAT RUTE AUTENTIKASI BAWAAN LARAVEL BREEZE
// ========================================================================
// Baris ini mengincludekan semua rute yang berkaitan dengan autentikasi
// seperti login, register, logout, reset password, dll.
// File-file rute ini berada di direktori 'routes/' (misal: routes/auth.php).
require __DIR__ . '/auth.php';