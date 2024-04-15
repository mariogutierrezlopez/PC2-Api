<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JugadorResource extends JsonResource
{
    public function toArray($request)
    {
        //CAMPOS
        return [
            'id' => $this->id,
            'id_web' => $this->id_web,
            'nombre' => $this->nombre_del_jugador,
            'equipo_id' => $this->id_equipo,
            'posicion' => $this->posicion,
            'fecha' => $this->fecha,
        ];
    }
}
