<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JugadoresPosesionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'id_jugador' => $this->id_jugador,
            'fecha' => $this->fecha,
        ];
    }
}