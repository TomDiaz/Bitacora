<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\especie;
use App\Models\ArtePesca;
use App\Models\Capitan;
use App\Models\Embarcacion;
use Illuminate\Support\Facades\DB;

class MetricasController extends Controller
{
    
    public function index(Request $req){

        $arte_pesca = ArtePesca::all();
        $embarcaciones = Embarcacion::where('IdArmador', auth()->user()->id)->get();
        $capitanes = Capitan::where('id_armador', auth()->user() -> id)->get();

        $especies_db = DB::table('lances')
        ->join('bitacora', 'lances.id_bitacora', '=', 'bitacora.id')
        ->join('lance_arte_de_pesca', 'lances.id', '=', 'lance_arte_de_pesca.id_lance')
        ->join('especie_lance', 'lances.id', '=', 'especie_lance.id_lance')
        ->join('especies', 'especie_lance.id_especie', '=', 'especies.id')
        ->where('id_armador', auth()->user() -> id);
       


        if( $req -> get('tipo') ){
            $especies_db ->where('id_tipo', $req -> get('tipo'));
        }
        
        if( $req -> get('capitan') ){
            $especies_db ->where('id_capitan', $req -> get('capitan'));
        }

        if( $req -> get('embarcacion') ){
            $especies_db ->where('id_embarcacion', $req -> get('embarcacion'));
        }

        if( $req -> get('arte') ){
            $especies_db ->where('id_arte', $req -> get('arte'));
        }

        if( $req -> get('fecha') ){
            $especies_db ->where('lances.fecha_final', $req -> get('fecha'));
        }

        if( $req -> get('especie') ){
            $especies_db ->where('especies.nombre','LIKE', '%'. $req -> get('especie'). '%');
        }



        $especies = array();


        foreach ($especies_db  -> get() as $data){

            $especie = [
                'nombre' => especie::find($data -> id_especie) -> nombre,
                'kilogramos' => $data -> kilogramos,
                'cantidad' => $data -> unidades,
                'tipo' => $data -> id_tipo,
            ];

            $especies[] =  $especie;
        }


        return view('reportes.metricas', compact('especies', 'arte_pesca', 'embarcaciones', 'capitanes'));
    }

}
