<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JugadorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_web' => $this->id_web,
            'nombre_del_jugador' => $this->nombre_del_jugador,
            'id_equipo' => $this->id_equipo,
            'posicion' => $this->posicion,
            'fecha' => $this->fecha,
            'equipo_id_web' => $this->equipo_id_web, // Asegúrate de incluir el equipo_id_web
        ];
    }
}
