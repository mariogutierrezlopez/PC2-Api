<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionUsuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $fillable = [
        'nombre_de_usuario',
        'nombre_mister',
        'correo',
        'pass',
        'pass_mister',
        'nombre',
        'apellido',
        'fecha_nacimiento',
    ];
    public $timestamps = false;
}