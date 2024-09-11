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
use App\Models\User;
use App\Models\Capitan;
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\BitacoraArtePesca;
use App\Http\Resources\BitacoraResource;
use App\Notifications\EnvioPDFCapitan;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class BitacorasController extends Controller
{
    

    public function store(Request $req){


       try{

          if(!Capitan::find($req -> id_capitan)){
            return  response()->json(['msj' => 'Id Capitan no registrado' ],404);
          }
          if(!Embarcacion::find($req -> id_embarcacion)){
            return  response()->json(['msj' => 'Id Embarcacion no registrado' ],404);
          }

          $bitacora = bitacora::create([
            'id_capitan' => $req -> id_capitan, 
            'nombre'=> $req -> nombre ,
            'viaje_anual'=> $req -> viaje_anual ,
            'tripulantes'=> $req -> tripulantes ,
            'marea' => $req -> marea,
            'fecha_inicial'=> $req -> fecha_inicial ,
            'fecha_final'=> $req -> fecha_final ,
            'id_embarcacion'=> $req -> id_embarcacion ,
            'observador_a_bordo' => $req -> observador_a_bordo,
            'id_zona_de_pesca' => $req -> id_zona_de_pesca, 
            'id_puerto_zarpe'=> $req -> id_puerto_zarpe ,
            'id_puerto_arribo'=> $req -> id_puerto_arribo ,
            'combustible'=> $req -> combustible ,
            'millas_recogidas'=> $req -> millas_recogidas ,
            'produccion'=> $req -> produccion ,
            'observaciones_generales'=> $req -> observaciones_generales,
            'observacion_parte_pesca'=> $req -> observacion_parte_pesca,
            'prospeccion'  => $req -> prospeccion,
            'subarea' => $req -> subarea,
            'mitigacion' => $req -> mitigacion, 
          ]);


          BitacoraArtePesca::create([
              'id_bitacora' =>  $bitacora -> id,
              'id_arte' => $req -> artes_de_pesca['id_arte'],
              'tamanio' => $req -> artes_de_pesca['tamanio'],
              'tipo_malla' => $req -> artes_de_pesca['tipo_malla'],
              'luz_malla' => $req -> artes_de_pesca['luz_malla'],
              'nombre_dispositivo' =>  $req -> artes_de_pesca['nombre_dispositivo']
            ]);

         

          ///Se guardan los lances
          foreach($req -> lances as $lance){

              $new_lance = lance::create([
                'id_bitacora' => $bitacora -> id, 
                'nombre' => $lance['nombre'], 
                'fecha_inicial' => $lance['fecha_inicial'], 
                'fecha_final' => $lance['fecha_final'], 
                'sin_captura' => $lance['sin_captura'], 
                'temperatura' => $lance['temperatura'], 
                'otro' => $lance['otro'], 
                'progreso' => $lance['progreso'], 
                'viento' => $lance['viento'],
                'observaciones' => $lance['observaciones']
              ]);

              foreach($lance['coordenadas'] as $coordenada){
  
                coordenada::create([
  
                  'id_lance' => $new_lance -> id,
                  'latitud' => $coordenada['latitud'],
                  'longitud' => $coordenada['longitud'],
  
                ]);
  
              }

              foreach($lance['especies'] as $especie){
  
                especieLance::create([
                  'id_lance' => $new_lance -> id,
                  'id_especie' =>  $especie['id_especie'],
                  'id_tipo' =>  $especie['id_tipo'],
                  'kilogramos' =>  $especie['kilogramos'],
                  'cajones' =>  $especie['cajones'],
                  'talla_tamanio' =>  $especie['talla_tamanio'],
                  'unidades' =>  $especie['unidades'],
                  'id_armador' => User::find( Capitan::find($req -> id_capitan) -> id_armador) -> id
                ]);
  
              }

          }


          $this -> sendEmail($bitacora -> id);

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



    public function exportar(Request $req){

        $data = array();
        $data_procesada = array();
        
        $bitacora = DB::table('bitacora')
                 ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
                 ->where('IdArmador',1)
                 ->get();

        $coleccion =   BitacoraResource::collection($bitacora);

        foreach( $coleccion  as $item){
            $data[] =  json_decode(json_encode($item), true);
        }

         
        $check_bitacora = $req -> check_bitacora;
        $check_lance = $req -> check_lance;
        $check_especie =  $req -> check_especie;


        foreach($data as $bitacora){  //CAPA BITACORA
          
              if($check_bitacora){

                $data_procesada[] = [
                  //Bitacora
                 'Nº de bitacora' => $bitacora['nombre'],
                 'Embarcación - Nombre' => $bitacora['embarcacion'],
                 'Embarcación - Matrícula' => $bitacora['matricula'],
                 'Capitán - Nombre y Apellido' => $bitacora['capitan'],
                 'Capitán - CUIL' =>  $bitacora['capitan_cuil'],
                 'N° de tripulantes' =>  $bitacora['tripulantes'],
                 'Fecha' => $bitacora['fecha_inicial'],
                 'Año' => $bitacora['fecha_inicial'],
                 'Marea' => $bitacora['marea'],
                 'Puerto de zarpe' => $bitacora['puerto_zarpe'],
                 'Puerto de desembarque' => $bitacora['puerto_arribo'],
                 'Millas recorridas' =>  $bitacora['millas_recogidas'],
                 'Combustible' =>  $bitacora['combustible'],
                 'Producción total' =>  $bitacora['produccion'],
                 'Observaciones generales' =>  $bitacora['observaciones_generales'],
                 'Observaciones parte de pesca' =>  $bitacora['observacion_parte_pesca'],
                 'Prospección' => $bitacora['prospeccion'],
                 'Observador a bordo' => $bitacora['observador_a_bordo'],
                 'Mitigación bycatch' => $bitacora['mitigacion'],
                 'Fecha y hora de zarpe' => $bitacora['fecha_inicial'],
                 'Fecha y hora de desembarque' => $bitacora['fecha_final'],
                 'Subárea' => $bitacora['subarea'],
                 'Zona de pesca' => $bitacora['zona_pesca'],
                 'Dispositivo de selectividad' => $bitacora['arte_pesca'][0]['nombre_dispositivo'],
                  
               ];

              }

           foreach($bitacora['lances'] as $lance){ //CAPA LANCES

                 if($check_lance){

                   $data_procesada[] = [
                     //Bitacora
                    'Nº de bitacora' => $bitacora['nombre'],
                    'Embarcación - Nombre' => $bitacora['embarcacion'],
                    'Embarcación - Matrícula' => $bitacora['matricula'],
                    'Capitán - Nombre y Apellido' => $bitacora['capitan'],
                    'Capitán - CUIL' =>  $bitacora['capitan_cuil'],
                    'N° de tripulantes' =>  $bitacora['tripulantes'],
                    'Fecha' => $bitacora['fecha_inicial'],
                    'Año' => $bitacora['fecha_inicial'],
                    'Marea' => $bitacora['marea'],
                    'Puerto de zarpe' => $bitacora['puerto_zarpe'],
                    'Puerto de desembarque' => $bitacora['puerto_arribo'],
                    'Millas recorridas' =>  $bitacora['millas_recogidas'],
                    'Combustible' =>  $bitacora['combustible'],
                    'Producción total' =>  $bitacora['produccion'],
                    'Observaciones generales' =>  $bitacora['observaciones_generales'],
                    'Observaciones parte de pesca' =>  $bitacora['observacion_parte_pesca'],
                    'Prospección' => $bitacora['prospeccion'],
                    'Observador a bordo' => $bitacora['observador_a_bordo'],
                    'Mitigación bycatch' => $bitacora['mitigacion'],
                    'Fecha y hora de zarpe' => $bitacora['fecha_inicial'],
                    'Fecha y hora de desembarque' => $bitacora['fecha_final'],
                    'Subárea' => $bitacora['subarea'],
                    'Zona de pesca' => $bitacora['zona_pesca'],
                    'Dispositivo de selectividad' => $bitacora['arte_pesca'][0]['nombre_dispositivo'],
                    //Lance
                    'Nº Lance' => $lance['nombre'],
                    'Temperatura' => $lance['temperatura'],
                    'Viento' =>  $lance['viento'],
                    'Coordenadas Inicio' => $lance['coordenadas'][0]['latitud'] . ' - ' . $lance['coordenadas'][0]['longitud'] ,
                    'Coordenadas Fin' => $lance['coordenadas'][1]['latitud'] . ' - ' . $lance['coordenadas'][1]['longitud'] ,
                  ];

                 }

               foreach($lance['especies'] as $especie){ //CAPA ESPECIES

                    if($check_especie){
                      $data_procesada[] = [
                         //Bitacora
                        'Nº de bitacora' => $bitacora['nombre'],
                        'Embarcación - Nombre' => $bitacora['embarcacion'],
                        'Embarcación - Matrícula' => $bitacora['matricula'],
                        'Capitán - Nombre y Apellido' => $bitacora['capitan'],
                        'Capitán - CUIL' =>  $bitacora['capitan_cuil'],
                        'N° de tripulantes' =>  $bitacora['tripulantes'],
                        'Fecha' => $bitacora['fecha_inicial'],
                        'Año' => $bitacora['fecha_inicial'],
                        'Marea' => $bitacora['marea'],
                        'Puerto de zarpe' => $bitacora['puerto_zarpe'],
                        'Puerto de desembarque' => $bitacora['puerto_arribo'],
                        'Millas recorridas' =>  $bitacora['millas_recogidas'],
                        'Combustible' =>  $bitacora['combustible'],
                        'Producción total' =>  $bitacora['produccion'],
                        'Observaciones generales' =>  $bitacora['observaciones_generales'],
                        'Observaciones parte de pesca' =>  $bitacora['observacion_parte_pesca'],
                        'Prospección' => $bitacora['prospeccion'],
                        'Observador a bordo' => $bitacora['observador_a_bordo'],
                        'Mitigación bycatch' => $bitacora['mitigacion'],
                        'Fecha y hora de zarpe' => $bitacora['fecha_inicial'],
                        'Fecha y hora de desembarque' => $bitacora['fecha_final'],
                        'Subárea' => $bitacora['subarea'],
                        'Zona de pesca' => $bitacora['zona_pesca'],
                        'Dispositivo de selectividad' => $bitacora['arte_pesca'][0]['nombre_dispositivo'],
                        //Lance
                        'Nº Lance' => $lance['nombre'],
                        'Temperatura' => $lance['temperatura'],
                        'Viento' =>  $lance['viento'],
                        'Coordenadas Inicio' => $lance['coordenadas'][0]['latitud'] . ' - ' . $lance['coordenadas'][0]['longitud'] ,
                        'Coordenadas Fin' => $lance['coordenadas'][1]['latitud'] . ' - ' . $lance['coordenadas'][1]['longitud'] ,
                         
                         //Especie
                        'Nombre común' => $especie['nombre'],
                        'Nombre científico' => $especie['nombre_cientifico'],
                        'Nombre científico' => $especie['nombre_cientifico'],
                        'kg' => $especie['kilogramos'],
                        'Cajones' => $especie['cajones'],
                        'Unidades' => $especie['unidades'],
                        'Talla' => $especie['talla_tamanio'],
                        'Tipo de especie' => $especie['tipo'],
                        'es' => $especie

                      ];
                    }

               }
            
           }

        }

      
      
        return  $data_procesada;
      }


      public function apiEmailCapitan($id) {

        $this -> sendEmail($id);

        return "Email enviado";

      }

  
      public function sendEmail($id){

        try{

          $capitan = Capitan::find( bitacora::find($id) -> id_capitan );

          Notification::route('mail',  $capitan -> email) -> notify(
            new EnvioPDFCapitan($id)
          );
          
        }
        catch(Exception $e){

        }
 
      

      }


}
