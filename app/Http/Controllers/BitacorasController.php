<?php

namespace App\Http\Controllers;

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

        $bitacoras = BitacoraResource::collection(bitacora::latest('fecha_inicial')->paginate($page))->resolve();
        $bitacoras_bd = bitacora::latest('fecha_inicial')->paginate($page);

        return view('reportes.bitacora',  compact('bitacoras','bitacoras_bd'));
     
    }


     public function PDF_PartePesca($id){

        $bitacora = bitacora::find($id);

        $especies = DB::table('especie_lance')
                   ->join('lances', 'especie_lance.id_lance', '=', 'lances.id')
                   ->join('especies', 'especie_lance.id_especie', '=', 'especies.id')
                   ->where('lances.id_bitacora',47)
                   ->get();

        $arte_pesca = DB::table('lance_arte_de_pesca')
                   ->join('lances', 'lance_arte_de_pesca.id_lance', '=', 'lances.id')
                   ->join('artepesca', 'lance_arte_de_pesca.id_arte', '=', 'artepesca.id')
                   ->where('lances.id_bitacora',47)
                   ->first();

        $data = [
           'bitacora' =>  $bitacora,
           'embarcacion' => $embarcacion =  Embarcacion::find($bitacora -> id_embarcacion),
           'armador' => $armador = User::find($embarcacion -> IdArmador),
           'times' => $this -> separarFecha($bitacora -> fecha_inicial, $bitacora -> fecha_final),
           'puerto' =>  $this -> getPuertos($bitacora -> id_puerto_zarpe, $bitacora -> id_puerto_arribo),
           'especies' => $especies,
           'arte_pesca' => $arte_pesca
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

     

}
