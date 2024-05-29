<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrediPrecio extends Model
{
    use HasFactory;

    protected $table = 'PrediPrecio';

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador');
    }
}
