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
        $capitanes_bd = Capitan::latest('FechaRegistro')->where('IdArmador', auth()->user() -> id)->paginate(10);

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
        Capitan::create([

            'IdTipoIdentificacion' =>  'C',
            'Identificacion' => $request -> nro_identificacion,
            'Nombres' =>  $request -> nombre,
            'Apellidos' => $request -> apellido,
            'Celular' => $request -> celular,
            'Email' => $request -> email,
            'Usuario' => $request -> usuario,
            'Clave' => $request -> clave1,
            'Estado' => 'A',
            'IdArmador' => auth()->user() -> id 

        ]);

        return redirect('/capitanes')->with('mensaje', 'Capitan agregado con exito!!');
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
        
        $capitan -> IdTipoIdentificacion =  'C';
        $capitan -> Identificacion = $request -> nro_identificacion;
        $capitan -> Nombres =  $request -> nombre;
        $capitan -> Apellidos = $request -> apellido;
        $capitan -> Celular = $request -> celular;
        $capitan -> Email = $request -> email;
        $capitan -> Usuario = $request -> usuario;
        $capitan -> Clave = $request -> clave1;
        $capitan -> Estado = 'A';
        $capitan -> IdArmador =  auth()->user() -> id; 

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
        $capitan->delete();


        return redirect('/capitanes');
    }
}
