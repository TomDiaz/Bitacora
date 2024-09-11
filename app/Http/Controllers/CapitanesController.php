<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitan;
use App\Models\CapitanEmbarcacion;
use App\Models\Embarcacion;
use App\Models\capitan_armador;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class CapitanesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capitanes = array();
        $capitanes_bd = Capitan::latest('fecha_registro')->where('id_armador', auth()->user() -> id)->where('estado',1)->paginate(10);

        foreach( $capitanes_bd as $capitan){

            $embarcaciones = array();

            foreach(CapitanEmbarcacion::all() as $capita_embarcaciones){

                if($capitan -> IdCapitan == $capita_embarcaciones -> IdCapitan){
                        $total = Embarcacion::where('IdEmbarcacion',$capita_embarcaciones -> IdEmbarcacion)-> count();
                        if( $total > 0){
                            $embarcaciones[] = Embarcacion::where('IdEmbarcacion',$capita_embarcaciones -> IdEmbarcacion)-> get();
                        }
                }
            }

            $addCapitan = [
                'capitan' => $capitan,
                'embarcaciones' => $embarcaciones
            ];

            $capitanes[] =  $addCapitan;

        }

        return view('capitanes.index', compact('capitanes','capitanes_bd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('capitanes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{

            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'usuario' => 'required',
                'clave' => 'required|string|confirmed',
                'cuil' => 'required',
            ]);

            $capitan = Capitan::create([
    
                'cuil' => $request -> cuil,
                'nombres' =>  $request -> nombre,
                'apellidos' => $request -> apellido,
                'celular' => $request -> celular,
                'email' => $request -> email,
                'usuario' => $request -> usuario,
                'clave' => Hash::make($request -> clave),
                'estado' => 1,
                'id_armador' => auth()->user() -> id 
    
            ]);

            capitan_armador::create([
                'id_capitan' =>  $capitan -> id,
                'id_armador' =>  auth()->user() -> id,
                'token' =>  Str::random(32),
                'estado' => 1
            ]);
    
            return response()->json(["msj" => "Capitan agregado con exito!!", "type" => "success"],201);

        } 
        catch ( \Exception $e) {
             return response()->json(['msj'=>'Datos incorrectos',"type" => "error", "err" => $e],500);
        }
      

        //return redirect('/capitanes')->with('mensaje', 'Capitan agregado con exito!!');
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_api(Request $request)
    {


            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'usuario' => 'required',
                'clave' => 'required',
                'cuil' => 'required',
            ]);


            $pass = Hash::make($request -> clave);

            $user_armador = User::create([
                'name' =>  $request -> nombre,
                'last_name' => $request -> apellido,
                'email' => $request -> email,
                'password' =>  $pass,
                'terminos_condiciones' => true,
                'empresa' =>  $request -> nombre . " " . $request -> apellido 
            ]);

            $capitan = Capitan::create([
    
                'cuil' => $request -> cuil,
                'nombres' =>  $request -> nombre,
                'apellidos' => $request -> apellido,
                'celular' => $request -> celular,
                'email' => $request -> email,
                'usuario' => $request -> usuario,
                'clave' => $pass,
                'estado' => 1,
                'id_armador' =>  $user_armador -> id 
    
            ]);

            capitan_armador::create([
                'id_capitan' =>  $capitan -> id,
                'id_armador' =>  $user_armador -> id,
                'token' =>  Str::random(32),
                'estado' => 1
            ]);

     
    
            return response()->json(["msj" => "Capitan agregado con exito!!", "type" => "success", "data" => $capitan ],201);
      

    }


    public function storeKey($id, Request $request){

        try{

          $request->validate([
              'clave' => 'required|string|confirmed',
          ]);
  
          $capitan = Capitan::find($id);
          $capitan -> clave = Hash::make($request -> clave);
          $capitan -> save();
  
          return response()->json(["msj" => "Clave modificada", "type" => "success"],201);

        } 
        catch ( \Exception $e) {
            return response()->json(['msj'=>'Datos incorrectos',"type" => "error", "err" => $e],500);
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capitan = Capitan::find($id);
        return view('capitanes.edit', compact('capitan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $capitan = Capitan::find($id);
        
        $capitan -> cuil = $request -> cuil;
        $capitan -> nombres =  $request -> nombre;
        $capitan -> apellidos = $request -> apellido;
        $capitan -> celular = $request -> celular;
        $capitan -> email = $request -> email;
        $capitan -> id_armador =  auth()->user() -> id; 

        $capitan->save();

        return redirect('/capitanes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capitan = Capitan::find($id);
        $data = $capitan -> nombres . " " . $capitan -> apellidos;
        $capitan -> estado = 0;
        $capitan -> save();

        return response()->json(["capitan" => $data],201);
    }


    public function filterCapitan($cuil){
        
        $capitan = Capitan::where('cuil', $cuil)->first();
        
        if($capitan){
            return response()->json( $capitan,200);
        }

        return response()->json( ['msj' => 'Cuil no registrado'],404);
    }


    public function solicitud($token){

        $capitan_armador = capitan_armador::where('token', $token) -> first();

        if($capitan_armador -> estado == 0){

            $capitan_armador -> estado = 1;
            $capitan_armador -> save();
    
            return view('solicitud.aceptado');
        }

        return view('solicitud.usado');

    }

}
