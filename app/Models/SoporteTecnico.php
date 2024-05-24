<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoporteTecnico extends Model
{
    use HasFactory;

    protected $fillable = ['correo', 'problema', 'descripcion'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'correo', 'correo');
    }

    public $timestamps = false; // Deshabilitar marcas de tiempo
    protected $table = 'soporte_tecnico';
}
