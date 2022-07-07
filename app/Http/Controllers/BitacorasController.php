<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipoEspecie;
use App\Models\especie;
use App\Models\puerto;
use App\Models\Embarcacion;
use App\Models\Capitan;
use App\Models\zonaPesca;
use App\Models\ArtePesca;
use App\Models\bitacora;
use App\Models\lance;
use App\Models\User;
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\BitacoraArtePesca;
use App\Http\Resources\BitacoraResource;
use Illuminate\Support\Facades\DB;
use PDF;

class BitacorasController extends Controller
{
    
    public function index(){

        $page = 10;

        $filtro = DB::table('bitacora')
                 ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
                 ->where('IdArmador',auth()->user() -> id)
                 ->latest('fecha_inicial')
                 ->paginate($page);


        $bitacoras = BitacoraResource::collection($filtro)->resolve();
        $bitacoras_bd = $filtro;


        return view('reportes.bitacora',  compact('bitacoras','bitacoras_bd'));
     
    }


    public function destroy($id){

      $bitacora = bitacora::find($id);
      $data = $bitacora -> nombre;

      foreach(BitacoraArtePesca::where('id_bitacora', $id)->get() as $arte){
         $arte ->delete();
      }

      foreach(lance::where('id_bitacora', $id)->get() as $lance){

         foreach(coordenada::where('id_lance',$lance->id)->get() as $coordenada){
            $coordenada -> delete();
         }

         foreach(especieLance::where('id_lance',$lance->id)->get() as $especie){
            $especie  -> delete();
         }

         $lance -> delete();
      }

      $bitacora->delete();

      return response()->json(["bitacora" => $data],201);
    }


     public function PDF_General($id){

        $bitacora = bitacora::find($id);
        $embarcacion =  Embarcacion::find($bitacora -> id_embarcacion);

        $general = [
            "bitacora" => $bitacora,
            "armador" => User::find($embarcacion -> IdArmador) -> name . " " . User::find($embarcacion -> IdArmador) -> last_name,
            "embarcacion" => $embarcacion,
            "capitan" => Capitan::find($bitacora -> id_capitan) -> nombres . " " . Capitan::find($bitacora -> id_capitan) -> apellidos,
            "inico" =>  $bitacora -> fecha_inicial,
            "cierre" =>  $bitacora -> fecha_final,
            "zarpe" => puerto::find( $bitacora -> id_puerto_zarpe) -> nombre,
            "arribo" => puerto::find( $bitacora -> id_puerto_arribo) -> nombre,
            "total_lances" => lance::where('id_bitacora', $id)->count(),
            "arte_pesca" => BitacoraArtePesca::where('id_bitacora',   $bitacora ->id) -> first()
        ];

         
         $lances = array();
         $procuccion_total = 0;
         $procuccion_total_retenidas = 0;
         //Lances de la mi bitacora
         foreach(lance::where('id_bitacora', $id)->get() as $lance){

            $especies_retenidas = array();
            $especies_otras = array();
   
            foreach(especieLance::where('id_lance', $lance -> id)->get() as $especie){

               $procuccion_total += $especie -> kilogramos;

               if($especie -> id_tipo == 1){

                  $procuccion_total_retenidas +=  $especie -> kilogramos;

                  $especie = [
                     "nombre_comun" =>  especie::find($especie -> id_especie) -> nombre,
                     "nombre_cientifico" => especie::find($especie -> id_especie) -> nombre_cientifico,
                     "peso" => $especie -> kilogramos,
                     "cajones" => $especie -> cajones,
                     "talla_tamanio" => $especie -> talla_tamanio,
                    
                  ];
   
                  $especies_retenidas[] = $especie;
               }

               else{

                  $tipo = explode(" ", tipoEspecie::find($especie -> id_tipo) -> nombre);

                  $especie = [
                     "nombre_comun" =>  especie::find($especie -> id_especie) -> nombre,
                     "nombre_cientifico" => especie::find($especie -> id_especie) -> nombre_cientifico,
                     "tipo" =>  $tipo[1],
                     "peso" => $especie -> kilogramos,
                     "unidades" => $especie -> unidades,
                  ];
   
                  $especies_otras[] = $especie;

               }

               

            }

            $coordenadas = coordenada::where('id_lance',  $lance -> id)->get();


            $lance = [
                "lance" => strtoupper($lance -> nombre),
                "arte_pesca" => ArtePesca::find(BitacoraArtePesca::where('id_bitacora', $bitacora -> id) -> first() -> id_arte)-> nombre,
                "zona_pesca" => zonaPesca::find( $bitacora -> id_zona_de_pesca) -> nombre,
                "inico" => $lance -> fecha_inicial,
                "fin" => $lance -> fecha_final,
                "laitud_i" =>  $coordenadas[0] -> latitud,
                "longitud_i" => $coordenadas[0] -> longitud,
                "laitud_f" =>  $coordenadas[1] -> latitud,
                "longitud_f" =>  $coordenadas[1] -> longitud,
                "especies_retenidas" => $especies_retenidas,
                "especies_otras" => $especies_otras,
                "temperatura" => $lance -> temperatura,
                "mitigacion" => $lance -> mitigacion,
                "otro" => $lance -> otro,
            ];

            $lances[] =  $lance;

         }


        $pdf = PDF::loadView('pdf.general', compact('general','lances','procuccion_total','procuccion_total_retenidas'));
        return $pdf->stream();
     }


     public function PDF_PartePesca($id){

        $bitacora = bitacora::find($id);

        $especies_db = DB::table('especie_lance')
                   ->join('lances', 'especie_lance.id_lance', '=', 'lances.id')
                   ->join('especies', 'especie_lance.id_especie', '=', 'especies.id')
                   ->where('especie_lance.id_tipo',1)
                   ->where('lances.id_bitacora',$id)
                   ->get();

        $especies = Array();


        foreach($especies_db as $especie){
                
                $zona = explode(":", zonaPesca::find( $bitacora -> id_zona_de_pesca) -> nombre);
                
                $especie = [
                    "especie" => $especie,
                    "coordenada" =>  coordenada::where('id_lance', $especie -> id_lance)->get(),
                    "zona" => $zona[0],
                    "progreso" => "HI: ". date("H:i", strtotime( $especie -> fecha_inicial)) . " | HF: " .  date("H:i", strtotime( $especie -> fecha_final)) . " | T: " . date("H:i", strtotime( lance::find( $especie -> id_lance) -> progreso)),
                    "lance" => lance::find( $especie -> id_lance) -> nombre . " del " . date("d/m/Y", strtotime(lance::find( $especie -> id_lance) -> fecha_inicial))  

                ];
    
                $especies[] =  $especie;
            
        }       
        
                   
        $arte_pesca = DB::table('bitacora_arte_de_pesca')
                   ->join('artepesca', 'bitacora_arte_de_pesca.id_arte', '=', 'artepesca.id')
                   ->where('bitacora_arte_de_pesca.id_bitacora',$id)
                   ->select('artepesca.nombre', 'bitacora_arte_de_pesca.tamanio', 'bitacora_arte_de_pesca.tipo_malla', 'bitacora_arte_de_pesca.luz_malla','bitacora_arte_de_pesca.nombre_dispositivo')
                   ->first();
    
        $data = [
           'bitacora' =>  $bitacora,
           'embarcacion' => $embarcacion =  Embarcacion::find($bitacora -> id_embarcacion),
           'armador' => $armador = User::find($embarcacion -> IdArmador),
           'times' => $this -> separarFecha($bitacora -> fecha_inicial, $bitacora -> fecha_final),
           'puerto' =>  $this -> getPuertos($bitacora -> id_puerto_zarpe, $bitacora -> id_puerto_arribo),
           'especies' => $especies,
           'arte_pesca' => $arte_pesca,
           'lances' => $arte_pesca ? true : false
        ];

      

        $pdf = PDF::loadView('pdf.partepesca', compact('data'));
        return $pdf->stream();
     }


     public function separarFecha($fecha_inicial, $fecha_final){

        $fechas = [$fecha_inicial, $fecha_final ];
        $tiempo = array();    

        $cont = 0;
        foreach($fechas as $fecha){
            $cont++;
            $separar_fecha = (explode(" ", $fecha));
            $fecha_b = $separar_fecha[0];
            $hora_b = $separar_fecha[1];

            $separar_fecha_b = (explode("-", $fecha_b));
            $separar_hora_b = (explode(":", $hora_b));


            $time = [
                'dia' =>  $separar_fecha_b[2],
                'mes' =>  $separar_fecha_b[1],
                'anio' =>  $separar_fecha_b[0],
                'hora' => $separar_hora_b[0],
                'minuto' => $separar_hora_b[1],
            ];

            $tiempo[] = $time;

        }

        return $tiempo;

     }


     public function getPuertos($zarpe, $arribo){

         
        return $puertos = [

            'zarpe' => puerto::find($zarpe) -> nombre,
            'arribo' => puerto::find($arribo) -> nombre,

        ];
     }


    public function getCantEspecies($cant){

        $mes = date('n');
        $anio =  intval(date('Y'));

        $cont = intval($mes) ;
        $kilogramos = array(); 

  
      

        for($i = 0; $i < $cant; $i++){
           
           $cantidad = 0;

           if($cont == 0){
             $cont = 12;
             $anio --;
           }

           $especies_retenidas = DB::table('lances')
           ->join('especie_lance', 'lances.id', '=', 'especie_lance.id_lance')
           ->where('id_armador', auth()->user() -> id)
           ->where('id_tipo', 1)
           -> whereMonth("fecha_final", $cont)
           -> whereYear("fecha_final",  $anio)
           ->get();

           foreach($especies_retenidas as $especie){
              $cantidad  +=  $especie -> kilogramos;
           }

           $data = [
              "kg" =>  $cantidad,
              "mes" =>  $cont,
              "anio" =>  $anio 
           ];

           $cont--;

           $kilogramos[] = $cantidad;

        }

        return  response()->json($kilogramos,200);
   }

     

}
