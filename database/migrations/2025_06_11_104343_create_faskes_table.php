<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel 'faskes'
        Schema::create('faskes', function (Blueprint $table) {
            $table->id(); // Kolom ID (Primary Key, auto-increment)
            $table->string('nama', 100); // Kolom 'nama' faskes, VARCHAR(100)
            $table->string('nama_pengelola', 45)->nullable(); // Bisa kosong (NULL)
            $table->string('alamat', 100);
            $table->string('website', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->integer('rating')->nullable(); // Rating dalam bentuk integer
            $table->double('latitude')->nullable(); // Koordinat geografis, bisa kosong
            $table->double('longitude')->nullable(); // Koordinat geografis, bisa kosong

            // Foreign Key ke tabel 'kabkotas'
            $table->foreignId('kabkota_id')->constrained('kabkotas')->onDelete('cascade');
            // Foreign Key ke tabel 'jenis_faskes'
            $table->foreignId('jenis_faskes_id')->constrained('jenis_faskes')->onDelete('cascade');
            // Foreign Key ke tabel 'kategoris'
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');

            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika migrasi di-rollback, hapus tabel 'faskes'
        Schema::dropIfExists('faskes');
    }
};