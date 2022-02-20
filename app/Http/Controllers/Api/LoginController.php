<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Capitan;
use App\Http\Resources\CapitanResource;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    
    public function login(Request $req){
        
       try{

           $capitan = Capitan::where('usuario', $req -> usuario)->first();
           $embarcaciones = DB::table('embarcacion')
                              ->join('capitanembarcacion', 'embarcacion.IdEmbarcacion', '=', 'capitanembarcacion.IdEmbarcacion')
                              ->where('capitanembarcacion.IdCapitan', $capitan -> id)
                              ->get();
   
           if (Hash::check( $req -> clave, $capitan -> clave)) {
               return  response()->json(['msj' => 'Acceso permitido', 'capitan' => new CapitanResource($capitan), 'embarcaciones' => $embarcaciones],200);
           }
   
           return  response()->json(['msj' => 'Capitan no econtrado' ],404);

       } 
       catch (\Exception $e) {
        report($e);
        return response()->json(['msj'=>'Server error','err'=>$e],500);
       }


    }

}
