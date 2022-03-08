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
use App\Models\lanceArtePesca;
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


     public function PDF_General($id){

        $bitacora = bitacora::find($id);
        $embarcacion =  Embarcacion::find($bitacora -> id_embarcacion);

        $general = [
            "armador" => User::find($embarcacion -> IdArmador) -> name,
            "embarcacion" => $embarcacion,
            "capitan" => Capitan::find($bitacora -> id_capitan) -> nombres . " " . Capitan::find($bitacora -> id_capitan) -> apellidos,
            "inico" =>  $bitacora -> fecha_inicial,
            "cierre" =>  $bitacora -> fecha_final,
            "zarpe" => puerto::find( $bitacora -> id_puerto_zarpe) -> nombre,
            "arribo" => puerto::find( $bitacora -> id_puerto_arribo) -> nombre,
            "total_lances" => lance::where('id_bitacora', $id)->count(),
            "obsevaciones" => $bitacora -> observaciones
        ];

         
         $lances = array();
         //Lances de la mi bitacora
         foreach(lance::where('id_bitacora', $id)->get() as $lance){

            $especies = array();
   
            foreach(especieLance::where('id_lance', $lance -> id)->get() as $especie){

                 $especie = [
                    "nombre_comun" =>  especie::find($especie -> id_especie) -> nombre,
                    "nombre_cientifico" => especie::find($especie -> id_especie) -> nombre_cientifico,
                    "peso" => $especie -> kilogramos,
                    "cantidad" => $especie -> unidades,
                   
                 ];

                 $especies[] = $especie;
            }

            $coordenadas = coordenada::where('id_lance',  $lance -> id)->get();

            $zona = explode(":", zonaPesca::find( $lance -> id_zona_de_pesca) -> nombre);

            $lance = [
                "lance" => $lance -> nombre,
                "arte_pesca" => ArtePesca::find(lanceArtePesca::where('id_lance', $lance -> id) -> first() -> id_arte)-> nombre,
                "zona_pesca" => $zona[0],
                "inico" => $lance -> fecha_inicial,
                "fin" => $lance -> fecha_final,
                "laitud_i" =>  $coordenadas[0] -> latitud,
                "longitud_i" => $coordenadas[0] -> longitud,
                "laitud_f" =>  $coordenadas[1] -> latitud,
                "longitud_f" =>  $coordenadas[1] -> longitud,
                "especies" => $especies
            ];

            $lances[] =  $lance;

         }


        $pdf = PDF::loadView('pdf.general', compact('general','lances'));
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
                
                $zona = explode(":", zonaPesca::find( $especie -> id_zona_de_pesca) -> nombre);
                
                $especie = [
                    "especie" => $especie,
                    "coordenada" =>  coordenada::where('id_lance', $especie -> id_lance)->get(),
                    "zona" => $zona[0],
                    "progreso" => "HI: ". date("H:i", strtotime( $especie -> fecha_inicial)) . " | HF: " .  date("H:i", strtotime( $especie -> fecha_final)) . " | T: " . date("H:i", strtotime( lance::find( $especie -> id_lance) -> progreso)),
                    "lance" => lance::find( $especie -> id_lance) -> nombre . " del " . date("d/m/Y", strtotime(lance::find( $especie -> id_lance) -> fecha_inicial))  

                ];
    
                $especies[] =  $especie;
            
        }       
        
                   
        $arte_pesca = DB::table('lance_arte_de_pesca')
                   ->join('artepesca', 'lance_arte_de_pesca.id_arte', '=', 'artepesca.id')
                   ->join('lances', 'lance_arte_de_pesca.id_lance', '=', 'lances.id')
                   ->where('lances.id_bitacora',$id)
                   ->select('artepesca.nombre', 'lance_arte_de_pesca.tamanio', 'lance_arte_de_pesca.tipo_malla', 'lance_arte_de_pesca.luz_malla','lance_arte_de_pesca.nombre_dispositivo')
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
