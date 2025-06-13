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
        // Membuat tabel 'kategoris'
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id(); // Kolom ID (Primary Key, auto-increment)
            $table->string('nama', 50); // Kolom 'nama' kategori, VARCHAR(50)
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika migrasi di-rollback, hapus tabel 'kategoris'
        Schema::dropIfExists('kategoris');
    }
};