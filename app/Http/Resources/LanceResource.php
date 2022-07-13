<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\bitacora;
use App\Models\zonaPesca;
use App\Models\coordenada;
use App\Models\BitacoraArtePesca;
use App\Models\ArtePesca;

class LanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $coordenadas = coordenada::where('id_lance',$this -> id)->get();

        $arte_lance = BitacoraArtePesca::where('id_bitacora',$this -> id_bitacora)->get();

        $coord_i = [
             'latitud' => $coordenadas[0] -> latitud,
             'longitud' => $coordenadas[0] -> longitud,
        ];

        $coord_f = [
             'latitud' => $coordenadas[1] -> latitud,
             'longitud' => $coordenadas[1] -> longitud,
        ];

        return [
            'fecha_inicial' => $this -> fecha_inicial,
            'fecha_final' => $this -> fecha_final,
            'bitacora' => bitacora::find($this -> id_bitacora) -> nombre,
            'zona_de_pesca' =>  zonaPesca::find(bitacora::find($this -> id_bitacora) -> id_zona_de_pesca) -> nombre,
            'coordenadas_inicio' =>  $coord_i,
            'coordenadas_fin' =>  $coord_f,
            'arte_pesca' => ArtePesca::find($arte_lance[0] -> id_arte) -> nombre,
            'especies_objetivo' => "Sin",

        ];
    }
}
