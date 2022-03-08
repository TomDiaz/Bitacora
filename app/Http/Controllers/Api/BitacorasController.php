<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tipoEspecie;
use App\Models\especie;
use App\Models\puerto;
use App\Models\Embarcacion;
use App\Models\zonaPesca;
use App\Models\ArtePesca;
use App\Models\bitacora;
use App\Models\lance;
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\lanceArtePesca;
use App\Http\Resources\BitacoraResource;

class BitacorasController extends Controller
{
    

    public function store(Request $req){


       try{

          $bitacora = bitacora::create([
            'id_capitan' => $req -> id_capitan, 
            'id_embarcacion'=> $req -> id_embarcacion ,
            'id_puerto_zarpe'=> $req -> id_puerto_zarpe ,
            'id_puerto_arribo'=> $req -> id_puerto_arribo ,
            'nombre'=> $req -> nombre ,
            'viaje_anual'=> $req -> viaje_anual ,
            'tripulantes'=> $req -> tripulantes ,
            'fecha_inicial'=> $req -> fecha_inicial ,
            'fecha_final'=> $req -> fecha_final ,
            'combustible'=> $req -> combustible ,
            'millas_recogidas'=> $req -> millas_recogidas ,
            'produccion'=> $req -> produccion ,
            'observaciones'=> $req -> observaciones ,

          ]);



          foreach($req -> lances as $lance){


            $new_lance = lance::create([
              'id_bitacora' => $bitacora -> id, 
              'id_zona_de_pesca' => $lance['id_zona_de_pesca'], 
              'nombre' => $lance['nombre'], 
              'fecha_inicial' => $lance['fecha_inicial'], 
              'fecha_final' => $lance['fecha_final'], 
              'sin_captura' => $lance['sin_captura'], 
              'temperatura' => $lance['temperatura'], 
              'otro' => $lance['otro'], 
              'mitigacion' => $lance['mitigacion'], 
              'progreso' => $lance['progreso'], 
            ]);


            foreach($lance['coordenadas'] as $coordenada){

              coordenada::create([

                'id_lance' => $new_lance -> id,
                'latitud' => $coordenada['latitud'],
                'longitud' => $coordenada['longitud'],

              ]);

            }


            lanceArtePesca::create([

              'id_lance' => $new_lance -> id,
              'id_arte' => $lance['artes_de_pesca']['id_arte'],
              'tamanio' => $lance['artes_de_pesca']['tamanio'],
              'tipo_malla' => $lance['artes_de_pesca']['tipo_malla'],
              'luz_malla' => $lance['artes_de_pesca']['luz_malla'],
              'nombre_dispositivo' => $lance['artes_de_pesca']['nombre_dispositivo']

            ]);


            foreach($lance['especies'] as $especie){

              especieLance::create([

                'id_lance' => $new_lance -> id,
                'id_especie' =>  $especie['id_especie'],
                'id_tipo' =>  $especie['id_tipo'],
                'kilogramos' =>  $especie['kilogramos'],
                'cajones' =>  $especie['cajones'],
                'talla_tamanio' =>  $especie['talla_tamanio'],
                'unidades' =>  $especie['unidades'],

              ]);

            }
            

          }



          return  response()->json(['msj' => 'Bitacora agregada correctamente' ],201);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['msj'=>'Server error','err'=>  $e],500);
        }
    

    }


    public function historial($id){

      try{

      $bitacora = BitacoraResource::collection(bitacora::where('id_capitan', $id)->get());

      return  response()->json(['msj' => 'Historial', 'bitacora' => $bitacora ],201);

    } catch (\Exception $e) {
      report($e);
      return response()->json(['msj'=>'Server error','err'=>  $e],500);
    }

    }

}
