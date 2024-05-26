<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrediJugador extends Model
{
    use HasFactory;

    protected $table = 'prediJugador';

    protected $fillable = [
        'id_jugador', 'jornada', 'puntos_jornada', 'AS', 'puntos_AS', 
        'Marca', 'puntos_Marca', 'MD', 'puntos_MD', 'Sofascore', 
        'puntos_Sofascore', 'puntos_goles', 'puntos_penalti', 
        'puntos_amarillas', 'puntos_rojas', 'estado', 'fecha'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador');
    }
}
