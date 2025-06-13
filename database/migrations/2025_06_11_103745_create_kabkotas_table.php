<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kabkotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->double('latitude');
            $table->double('longitude');
            $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kabkotas');
    }
};
