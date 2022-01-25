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
    public function index()
    {
        $embarcaciones = Embarcacion::all();
     

        return view('embarcaciones.index', compact('embarcaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

        $embarcacion = Embarcacion::create([
            'IdArmador' => 10,
            'Nombre' => $request -> embarcacion,
            'Matricula' => $request -> matricula,
            'PermisoPesca' => $request -> permiso,
            'FechaVigenciaPermisoPesca' => $request -> fecha_caducidad,
            'Estado' => 'A' ,
            'Pais' => $request -> pais,
        ]);

        foreach($request-> capitanes as $capitan){
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
        $capitanes = Capitan::all();
        $artepesca = ArtePesca::all();

        return view('embarcaciones.edit', compact('embarcacion','capitanes', 'artepesca'));
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
        $embarcacion = Embarcacion::find($id);

        $embarcacion -> IdArmador = 1;
        $embarcacion -> Nombre = $request -> embarcacion;
        $embarcacion -> Matricula = $request -> matricula;
        $embarcacion -> PermisoPesca = $request -> permiso;
        $embarcacion -> FechaVigenciaPermisoPesca = $request -> fecha_caducidad;
        $embarcacion -> Estado = 'A';
        $embarcacion -> Pais = $request -> pais;

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
