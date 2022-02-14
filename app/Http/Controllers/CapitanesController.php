<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitan;
use App\Models\CapitanEmbarcacion;
use App\Models\Embarcacion;

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
        $capitanes_bd = Capitan::latest('fecha_registro')->where('id_armador', auth()->user() -> id)->paginate(2);

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
                'celular' => 'required',
                'email' => 'required',
                'usuario' => 'required',
                'clave1' => 'required',
                'cuil' => 'required|min:3',
            ]);

            Capitan::create([
    
                'cuil' => $request -> cuil,
                'nombres' =>  $request -> nombre,
                'apellidos' => $request -> apellido,
                'celular' => $request -> celular,
                'email' => $request -> email,
                'usuario' => $request -> usuario,
                'clave' => $request -> clave1,
                'estado' => 1,
                'id_armador' => auth()->user() -> id 
    
            ]);
    
            return response()->json(["msj" => "Capitan agregado con exito!!", "type" => "success"],201);

        } 
        catch ( \Exception $e) {
             return response()->json(['msj'=>'Datos incorrectos',"type" => "error"],500);
        }
      

        //return redirect('/capitanes')->with('mensaje', 'Capitan agregado con exito!!');
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
        $capitan -> usuario = $request -> usuario;
        $capitan -> clave = $request -> clave1;
        $capitan -> Estado = 1;
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
        $capitan->delete();


        return response()->json(["capitan" => $data],201);
    }
}
