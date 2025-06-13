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
        // Membuat tabel 'jenis_faskes'
        Schema::create('jenis_faskes', function (Blueprint $table) {
            $table->id(); // Kolom ID (Primary Key, auto-increment)
            $table->string('nama', 45); // Kolom 'nama' jenis faskes, VARCHAR(45)
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika migrasi di-rollback, hapus tabel 'jenis_faskes'
        Schema::dropIfExists('jenis_faskes');
    }
};