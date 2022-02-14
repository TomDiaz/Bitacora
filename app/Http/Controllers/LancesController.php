<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lance;
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\lanceArtePesca;
use App\Http\Resources\LanceResource;

class LancesController extends Controller
{
    
    public function index(){

        $page = 10;

        $lances = LanceResource::collection(lance::latest('fecha_inicial')->paginate($page))->resolve();
        $lances_bd = lance::latest('fecha_inicial')->paginate($page);

        return view('reportes.lance',  compact('lances','lances_bd'));

    }

}
