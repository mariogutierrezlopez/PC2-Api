<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuariosResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        //CAMPOS
        return [
            'id' => $this->id,
            'username' => $this->nombre_de_usuario,
            'email' => $this->correo,
            'name' => $this->nombre,
            'surname' => $this->apellido,
            'birthdate' => $this->fecha_nacimiento,
            'creation_date' => $this->fecha_creacion,
        ];
        
    }
}
