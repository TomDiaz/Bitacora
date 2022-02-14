<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\bitacora;
use App\Models\zonaPesca;
use App\Models\coordenada;
use App\Models\lanceArtePesca;
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

        $arte_lance = lanceArtePesca::where('id_lance', $this -> id)->get();

        return [
            'fecha_inicial' => $this -> fecha_inicial,
            'fecha_final' => $this -> fecha_final,
            'bitacora' => bitacora::find($this -> id_bitacora) -> nombre,
            'zona_de_pesca' =>  zonaPesca::find($this -> id_zona_de_pesca) -> nombre,
            'coordenadas_inicio' => $coordenadas[0] -> latitud . " - "  . $coordenadas[0] -> longitud,
            'coordenadas_fin' =>  $coordenadas[0] -> latitud . " - "  . $coordenadas[1] -> longitud,
            'arte_pesca' => ArtePesca::find($arte_lance[0] -> id_arte) -> nombre,
            'especies_objetivo' => "Sin"

        ];
    }
}
