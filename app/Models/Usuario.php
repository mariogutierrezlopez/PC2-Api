<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'usuarios';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = null;

    public function soporteTecnico()
    {
        return $this->hasMany(SoporteTecnico::class, 'correo', 'correo');
    }

    // TABLAS
    protected $fillable = [
        'nombre_de_usuario', 
        'nombre_mister', 
        'correo',
        'pass',
        'nombre', 
        'apellido', 
        'fecha_nacimiento',
        'role', 
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

    public function getAuthPassword()
    {
        return $this->pass;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
        ];
    }
}
