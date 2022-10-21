<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Capitan;
use App\Models\User;
use App\Models\capitan_armador;
use App\Http\Resources\CapitanResource;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    
    public function login(Request $req){
        
       try{
           
           $embarcaciones_aceptada = array();
           $capitan = Capitan::where('usuario', $req -> usuario)->first();

           if(!empty($capitan)){
               $embarcaciones = DB::table('embarcacion')
                                  ->join('capitanembarcacion', 'embarcacion.IdEmbarcacion', '=', 'capitanembarcacion.IdEmbarcacion')
                                  ->where('capitanembarcacion.IdCapitan', $capitan -> id)
                                  ->get();
    
               foreach( $embarcaciones as $embarcacion){
    
                    $capitan_armador =  capitan_armador::where('id_armador', $embarcacion -> IdArmador)->where('id_capitan', $capitan->id)->first();
    
                    if(!empty($capitan_armador) && $capitan_armador -> estado == 1){
    
                        $embarcaciones_aceptada[] = [
                            "IdEmbarcacion"=> $embarcacion -> IdEmbarcacion,
                            "IdArmador" => $embarcacion -> IdArmador,
                            "Nombre" => $embarcacion -> Nombre . " - " . User::find($capitan_armador -> id_armador) -> empresa,
                            "Matricula" => $embarcacion -> Matricula,
                            "PermisoPesca" => $embarcacion -> PermisoPesca,
                            "FechaVigenciaPermisoPesca" => $embarcacion -> FechaVigenciaPermisoPesca,
                            "Estado" => $embarcacion -> Estado,
                            "FechaRegistro" => $embarcacion -> FechaRegistro,
                            "Pais" => $embarcacion -> Pais,
                            "id_tipo_barco" => $embarcacion -> id_tipo_barco,
                            "IdCapitan" => $embarcacion -> IdCapitan,
                            "FechaIngreso" => $embarcacion -> FechaIngreso
                        ];
                    }
    
               }
                
       
               if (Hash::check( $req -> clave, $capitan -> clave)) {
                   return  response()->json(['msj' => 'Acceso permitido', 'capitan' => new CapitanResource($capitan), 'embarcaciones' => $embarcaciones_aceptada],200);
               }
       
               return  response()->json(['msj' => 'No autorizado' ],401);
           }

           return  response()->json(['msj' => 'Capitan no econtrado' ],404);

       } 
       catch (\Exception $e) {
        $errores_lista =[
            'error'=>$e->getMessage(),
            'line'=>$e->getline(),
            'file'=> $e->getfile(),
        ];
        return response()->json(['msj'=>'Server error','err'=>$errores_lista],500);
       }


    }

}
