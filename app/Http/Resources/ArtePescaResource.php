<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ArtePesca;

class ArtePescaResource extends JsonResource
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
            'arte' =>  ArtePesca::find($this -> id_arte) -> nombre,
            'tamanio' => $this -> tamanio ,
            'tipo_malla' => $this -> tipo_malla ,
            'luz_malla' => $this -> luz_malla ,
        ];
    }
}
