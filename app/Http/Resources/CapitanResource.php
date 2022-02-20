<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;


class CapitanResource extends JsonResource
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

            'id'=> $this -> id,
            'cuil'=> $this -> cuil,
            'nombre'=> $this -> nombres,
            'apellido'=> $this -> apellidos,
            'direccion'=> $this -> direccion,
            'celular'=> $this -> celular,
            'email'=> $this -> email,
            'fechaRegistro'=> $this -> fecha_registro,
            'armador' => User::find($this -> id_armador) -> name 
        ];
    }
}
