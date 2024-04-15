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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre_de_usuario', 100);
            $table->string('nombre_mister', 50);
            $table->string('correo', 100);
            $table->string('pass', 50);
            $table->string('pass_mister', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->date('fecha_nacimiento'); 
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
