<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Embarcacion;
use App\Models\Capitan;
use App\Models\CapitanEmbarcacion;
use App\Models\puerto;
use App\Models\zonaPesca;
use App\Models\coordenada;
use App\Models\lanceArtePesca;
use App\Models\ArtePesca;
use App\Models\especieLance;
use App\Models\lance;
use App\Http\Resources\CoordenadasResource;
use App\Http\Resources\ArtePescaResource;
use App\Http\Resources\EspeciesResource;

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

        $lances = array();

        foreach(lance::where('id_bitacora', $this -> id )-> get() as $data){
         

            $lance = [
                'nombre' => $data -> nombre,
                'fecha_inicial' => $data -> fecha_inicial,
                'fecha_final' => $data -> fecha_final,
                'sin_captura' => $data -> sin_captura,
                'temperatura' => $data -> temperatura,
                'otro' => $data -> otro,
                'mitigacion' => $data -> mitigacion,
                'progreso' => $data -> progreso,
                'coordenadas'=> CoordenadasResource::collection(coordenada::where('id_lance',  $data -> id)->get()),
                'especies' => EspeciesResource::collection(especieLance::where('id_lance',  $data -> id)->get())
            ];

            $lances[] =  $lance;
        }

        return [
            'id' => $this -> id,
            'nombre' => $this -> nombre,
            'fecha_inicial' => $this -> fecha_inicial,
            'fecha_final' => $this -> fecha_final,
            'embarcacion' => Embarcacion::find($this -> id_embarcacion) -> Nombre,
            'matricula' => Embarcacion::find($this -> id_embarcacion) -> Matricula, 
            'tripulantes' => $this -> tripulantes,
            'capitan' => Capitan::find($this -> id_capitan) -> nombres . ' ' . Capitan::find($this -> id_capitan) -> apellidos,
            'puerto_zarpe'=> puerto::find($this -> id_puerto_zarpe ) -> nombre,
            'puerto_arribo'=> puerto::find($this -> id_puerto_arribo) -> nombre,
            'viaje_anual'=> $this -> viaje_anual ,
            'combustible'=> $this -> combustible ,
            'millas_recogidas'=> $this -> millas_recogidas ,
            'produccion'=> $this -> produccion ,
            'marea' => $this -> marea,
            'lances' => $lances,
            'observaciones_generales' => $this -> observaciones_generales,
            'observacion_parte_pesca' => $this -> observacion_parte_pesca
        ];
    }
}
