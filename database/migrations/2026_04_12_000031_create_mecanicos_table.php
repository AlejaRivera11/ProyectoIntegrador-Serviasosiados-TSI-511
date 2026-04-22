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
        Schema::create('mecanicos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_documento', ['TI', 'CC', 'CE', 'PT', 'PE']);
            $table->string('documento_mecanico')->unique();
            $table->string('nombre_mecanico');
            $table->string('telefono_mecanico');
            $table->string('direccion_mecanico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecanicos');
    }
};
