<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 45);
            $table->string('ibukota', 45);
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinsis');
    }
};
