<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id(); // Esto creará una columna de tipo BIGINT y autoincremental.
            $table->bigInteger('id_web')->default(0); // Cambia esto según sea necesario.
            $table->string('nombre_del_jugador', 100);
            $table->foreignId('id_equipo')->constrained()->onDelete('cascade'); // Asegúrate de que la tabla de equipos exista.
            $table->string('posicion', 50);
            $table->timestamp('fecha')->useCurrent(); // Esto establecerá la fecha por defecto a la fecha y hora actual.

            // Otras columnas y definiciones...
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}
