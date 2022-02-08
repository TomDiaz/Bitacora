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

        ],200);

    } catch (\Exception $e) {
        report($e);
        return response()->json(['msj'=>'Server error','err'=>$e],500);
    }


    }

}
