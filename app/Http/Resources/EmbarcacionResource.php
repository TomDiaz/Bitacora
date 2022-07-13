<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\TipoBarco;

class EmbarcacionResource extends JsonResource
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
            'Nombre' => $this -> Nombre,
            'Matricula' =>  $this -> Matricula,
            'PermisoPesca' => $this -> PermisoPesca,
            'FechaVigenciaPermisoPesca' => $this -> FechaVigenciaPermisoPesca ,
            'tipo_barco' => TipoBarco::find($this -> id_tipo_barco) -> nombre
        ];
    }
}
