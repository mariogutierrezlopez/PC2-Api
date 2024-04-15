<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JornadasResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jornada' => $this->jornada,
            'id_local' => $this->id_local,
            'id_visitante' => $this->id_visitante,
            'fecha_partido' => $this->fecha_partido,
        ];
    }
}