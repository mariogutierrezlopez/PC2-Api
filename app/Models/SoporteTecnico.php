<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoporteTecnico extends Model
{
    use HasFactory;


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'correo', 'correo');
    }
    
    protected $table = 'soporte_tecnico';
}
