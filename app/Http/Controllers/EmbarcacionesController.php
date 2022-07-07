<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embarcacion;
use App\Models\ArtePesca;
use App\Models\CapitanEmbarcacion;
use App\Models\Capitan;


class EmbarcacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $embarcaciones = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->paginate(10);
     
       if($req->adminlteSearch){
         $embarcaciones = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('Nombre', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       };

       if(count($embarcaciones)==0){
          $embarcaciones = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('Matricula', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       }

       if(count($embarcaciones)==0){
          $embarcaciones = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('PermisoPesca', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       }



        return view('embarcaciones.index', compact('embarcaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        session_start();
        $_SESSION['capitanes'] = [];

        //$capitanes = Capitan::where('id_armador',  auth()->user()->id)->get();
        $capitanes = Capitan::all();
        $artepesca = ArtePesca::all();

        return view('embarcaciones.create', compact('capitanes', 'artepesca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        session_start();

        $validated = $request->validate([
            'embarcacion' => 'required',
            'matricula' => 'required',
            'permiso' => 'required',
            'fecha_caducidad' => 'required',
        ]);


        $embarcacion = Embarcacion::create([
            'IdArmador' => auth()->user() -> id,
            'Nombre' => $request -> embarcacion,
            'Matricula' => $request -> matricula,
            'PermisoPesca' => $request -> permiso,
            'FechaVigenciaPermisoPesca' => $request -> fecha_caducidad,
            'Estado' => 'A',
            'Pais' => 'Argentina',
        ]);

        foreach( $_SESSION['capitanes'] as $capitan){
           CapitanEmbarcacion::create([
            'IdCapitan' => $capitan,
            'IdEmbarcacion' =>  $embarcacion -> IdEmbarcacion
           ]);
        }


        return redirect('/embarcaciones');
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
      

        $embarcacion = Embarcacion::find($id);
        $capitanes = Capitan::where('id_armador',  auth()->user()->id)->get();
        $capitanes_array = array();
        $artepesca = ArtePesca::all();

        foreach(capitanembarcacion::where('IdEmbarcacion', $id)->get() as $capitan){
            $capitanes_array[] = Capitan::find($capitan -> IdCapitan)-> id;
        }

        session_start();
        $_SESSION['capitanes'] = $capitanes_array;


        return view('embarcaciones.edit', compact('embarcacion','capitanes', 'artepesca', 'capitanes_array'));
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
        session_start();

        $validated = $request->validate([
            'embarcacion' => 'required',
            'matricula' => 'required',
            'permiso' => 'required',
            'fecha_caducidad' => 'required',
        ]);

       
        $embarcacion = Embarcacion::find($id);

        $embarcacion -> Nombre = $request -> embarcacion;
        $embarcacion -> Matricula = $request -> matricula;
        $embarcacion -> PermisoPesca = $request -> permiso;
        $embarcacion -> FechaVigenciaPermisoPesca = $request -> fecha_caducidad;
   
        foreach(capitanembarcacion::where('IdEmbarcacion', $id)->get() as $capitan){
            $capitan -> delete();
        }   

        foreach( $_SESSION['capitanes'] as $capitan){
            CapitanEmbarcacion::create([
             'IdCapitan' => $capitan,
             'IdEmbarcacion' =>  $embarcacion -> IdEmbarcacion
            ]);
         }

        $embarcacion -> save();

        return redirect('/embarcaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $embarcacion = Embarcacion::find($id);
        $embarcacion->delete();


        return redirect('/embarcaciones');
    }


   


}
