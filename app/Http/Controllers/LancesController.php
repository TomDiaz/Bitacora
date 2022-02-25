<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lance;
use App\Models\coordenada;
use App\Models\especieLance;
use App\Models\lanceArtePesca;
use App\Http\Resources\LanceResource;
use Illuminate\Support\Facades\DB;

class LancesController extends Controller
{
    
    public function index(){

        $page = 10;

        $filtro = DB::table('bitacora')
        ->join('lances', 'bitacora.id', '=', 'lances.id_bitacora')
        ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
        ->where('IdArmador',auth()->user() -> id)
        ->latest('lances.fecha_inicial')
        ->paginate($page);       

        $lances = LanceResource::collection($filtro)->resolve();
        $lances_bd = $filtro;

        return view('reportes.lance',  compact('lances','lances_bd'));

    }

}
