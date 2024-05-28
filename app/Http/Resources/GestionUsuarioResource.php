<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GestionUsuarioResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre_de_usuario' => $this->nombre_de_usuario,
            'nombre_mister' => $this->nombre_mister,
            'correo' => $this->correo,
            'pass' => $this->pass,
            'pass_mister' => $this->pass_mister,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'fecha_creacion' => $this->fecha_creacion,
        ];
    }
}