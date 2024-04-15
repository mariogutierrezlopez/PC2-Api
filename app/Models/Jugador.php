<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jugadores';

    const CREATED_AT = 'fecha';
    const UPDATED_AT = null;

    //TABLAS
    protected $fillable = [
        'id_web', 
        'nombre_del_jugador', 
        'id_equipo', 
        'posicion', 
    ];

    //RELACIONES DE TABLAS
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo');
    }
}

