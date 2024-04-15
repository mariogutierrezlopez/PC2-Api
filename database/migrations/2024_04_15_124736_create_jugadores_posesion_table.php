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
        Schema::create('jugadores_en_posesion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained()->onDelete('cascade');
            $table->foreignId('id_jugador')->constrained()->onDelete('cascade');
            $table->timestamp('fecha')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores_en_posesion');
    }
};
