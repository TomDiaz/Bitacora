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
use App\Imports\EspeciesImport;
use App\Models\TipoBarco;
use Maatwebsite\Excel\Facades\Excel;
class RecursosController extends Controller
{
    //

    public function index(){

        try{

        return  response()->json([

            'especies' => especie::all(),
            'embarcaciones' => Embarcacion::all(),
            'puertos' => puerto::all(),
            'zona_de_pesca' =>  zonaPesca::all(),
            'artes_de_pescas' => ArtePesca::all(),
            'tipo_barcos' => TipoBarco::all()
            
        ],200);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['msj'=>'Server error','err'=>$e],500);
        }

    }


    public function importEspecies(Request $req){
      

        try{

            Excel::import(new EspeciesImport, $req -> file('file'));

            return response()->json(['msj'=>'Todo ok'],200);
    
        } catch (\Exception $e) {
            report($e);
            return response()->json(['msj'=>'Server error','err'=>$e],500);
        }

    }


    public function mayu(){
     
        foreach( especie::all() as $especie){

            $especie -> nombre = ucfirst($especie -> nombre);
            $especie -> nombre_cientifico = ucfirst($especie -> nombre_cientifico);
            $especie -> save();
        }
        
        return "listorti";

    }

}
