<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\tipoEspecie;
use App\Models\especie;

class EspeciesResource extends JsonResource
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

            'nombre' => especie::find($this -> id_especie) -> nombre,
            'nombre_cientifico' => especie::find($this -> id_especie) -> nombre_cientifico,
            'tipo' => tipoEspecie::find($this -> id_tipo) -> nombre ,
            'kilogramos' => $this -> kilogramos,
            'cajones' => $this -> cajones,
            'talla_tamanio' => $this -> talla_tamanio,
            'unidades' => $this -> unidades,
        ];
    }
}
