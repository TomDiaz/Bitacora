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

        $CapitanEmbarcacion = CapitanEmbarcacion::where('IdEmbarcacion', $this -> id_embarcacion)->get();

        $capitanes = '';

        $cont = 0;

        foreach($CapitanEmbarcacion as $capitan){

            $capitanes .=  capitan::find($capitan -> IdCapitan) -> nombres . ' ' . capitan::find($capitan -> IdCapitan) -> apellidos .' - ';
        }

        return [
            'nombre' => $this -> nombre,
            'fecha_inicial' => $this -> fecha_inicial,
            'fecha_final' => $this -> fecha_final,
            'embarcacion' => Embarcacion::find($this -> id_embarcacion) -> Nombre,
            'matricula' => Embarcacion::find($this -> id_embarcacion) -> Matricula, 
            'capitan' => $capitanes, 
            

        ];
    }
}
