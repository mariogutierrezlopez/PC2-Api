<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'equipos';

    const CREATED_AT = 'fecha';
    const UPDATED_AT = null; 

    protected $fillable = [
        'nombre_equipo',
    ];

    public function jugadores()
    {
        return $this->hasMany(Jugador::class, 'id_equipo', 'id');
    }

}

