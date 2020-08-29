<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'detalles' => $this->detalles,
            'id_enfermedad' => $this->id_enfermedad,
            'doctor_id' => $this->doctor_id,
            'paciente_id' => $this->paciente_id,
            'pago' => $this->pago,
            'observaciones' => $this->observaciones
        ];
    }
}
