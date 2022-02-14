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
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\lanceArtePesca;
use App\Http\Resources\BitacoraResource;

class BitacorasController extends Controller
{
    
    public function index(){

        $page = 10;

        $bitacoras = BitacoraResource::collection(bitacora::latest('fecha_inicial')->paginate($page))->resolve();
        $bitacoras_bd = bitacora::latest('fecha_inicial')->paginate($page);

        return view('reportes.bitacora',  compact('bitacoras','bitacoras_bd'));
     
    }

}
