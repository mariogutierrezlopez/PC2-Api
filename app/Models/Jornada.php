<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jornadas';

    const CREATED_AT = 'fecha_partido';
    const UPDATED_AT = null; 

    protected $fillable = [
        'jornada',
        'id_local',
        'id_visitante',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_local');
        return $this->belongsTo(Equipo::class, 'id_visitante');
    }
}

