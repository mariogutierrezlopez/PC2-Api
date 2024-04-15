<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'usuarios';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = null;

    //TABLAS
    protected $fillable = [
        'nombre_de_usuario', 
        'nombre_mister', 
        'correo', 
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
    ];

// Si deseas ocultar datos sensibles cuando se convierte el modelo a array o JSON
    protected $hidden = [
        'pass',
        'pass_mister',
    ];

    public function setPassAttribute($value)
    {
        $this->attributes['pass'] = bcrypt($value);
    }

    public function setPassMisterAttribute($value)
    {
        $this->attributes['pass_mister'] = bcrypt($value);
    }

    protected $dates = ['fecha_nacimiento'];
}
