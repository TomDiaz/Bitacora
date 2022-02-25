<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Embarcacion;
use App\Models\Capitan;
use App\Models\CapitanEmbarcacion;


class BitacoraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'id' => $this -> id,
            'nombre' => $this -> nombre,
            'fecha_inicial' => $this -> fecha_inicial,
            'fecha_final' => $this -> fecha_final,
            'embarcacion' => Embarcacion::find($this -> id_embarcacion) -> Nombre,
            'matricula' => Embarcacion::find($this -> id_embarcacion) -> Matricula, 
            'tripulantes' => $this -> tripulantes,
            'capitan' => Capitan::find($this -> id_capitan) -> nombres . ' ' . Capitan::find($this -> id_capitan) -> apellidos
        ];
    }
}
