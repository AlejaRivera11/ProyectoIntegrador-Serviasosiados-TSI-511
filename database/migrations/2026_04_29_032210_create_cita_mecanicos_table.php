<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cita_mecanicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('mecanico_id')->constrained('mecanicos');
            $table->foreignId('servicio_cita_id')->constrained('servicio_citas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_mecanicos');
    }
};
