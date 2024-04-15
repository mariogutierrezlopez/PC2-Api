<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadoresPosesion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jugadores_en_posesion';

    const CREATED_AT = 'fecha';
    const UPDATED_AT = null; 

    protected $fillable = [
        'id_usuario',
        'id_jugador',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador');
    }
}

