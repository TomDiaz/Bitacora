<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Embarcacion;
use App\Models\ArtePesca;
use App\Models\CapitanEmbarcacion;
use App\Models\Capitan;
use App\Models\TipoBarco;
use App\Models\capitan_armador;
use App\Http\Resources\EmbarcacionResource;
use App\Notifications\SolicitudCapitan;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmbarcacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $embarcaciones2 = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->paginate(10);
     
       if($req->adminlteSearch){
         $embarcaciones2 = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('Nombre', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       };

       if(count($embarcaciones2)==0){
          $embarcaciones2 = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('Matricula', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       }

       if(count($embarcaciones2)==0){
          $embarcaciones2 = Embarcacion::latest('FechaRegistro')->where('IdArmador', auth()->user()->id)->where('PermisoPesca', 'LIKE' ,'%'.$req->adminlteSearch.'%')->paginate(10);
       }

       $embarcaciones = EmbarcacionResource::collection($embarcaciones2);

       $tipo_barcos = TipoBarco::all();

        return view('embarcaciones.index', compact('embarcaciones','tipo_barcos'));
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

        $capitan_armador = capitan_armador::where('id_armador',  auth()->user()->id)->get();

        $capitanes = array();

        foreach($capitan_armador as $cap){
            $capitanes[] = Capitan::find($cap -> id_capitan);
        }

        $artepesca = ArtePesca::all();
        $tipo_barcos = TipoBarco::all();

        return view('embarcaciones.create', compact('capitanes', 'artepesca', 'tipo_barcos'));
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
            'id_tipo_barco' => $request -> barco
        ]);

        foreach( $_SESSION['capitanes'] as $capitan){
           CapitanEmbarcacion::create([
            'IdCapitan' => $capitan,
            'IdEmbarcacion' =>  $embarcacion -> IdEmbarcacion
           ]);

           $capitan_armador = capitan_armador::where('id_capitan',  $capitan)->where('id_armador', auth()->user()->id)->first();

           $token = Str::random(32);

           if(empty($capitan_armador)){
              capitan_armador::create([
                  'id_capitan' =>  $capitan,
                  'id_armador' =>  auth()->user() -> id,
                  'token' =>   $token,
                  'estado' => 0
              ]);

              Notification::route('mail', Capitan::find($capitan) -> email)->notify(new SolicitudCapitan($token));
           }
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
        $tipo_barcos = TipoBarco::all();

        foreach(capitanembarcacion::where('IdEmbarcacion', $id)->get() as $capitan){

            $capitan_armador =  capitan_armador::where('id_armador', auth()->user()->id)->where('id_capitan', $capitan -> IdCapitan)->first();

            if(!empty($capitan_armador) && $capitan_armador -> estado == 1){
                $capitanes_array[] = $capitan -> IdCapitan;
            }
        }

        session_start();
        $_SESSION['capitanes'] = $capitanes_array;


        return view('embarcaciones.edit', compact('embarcacion','capitanes', 'artepesca', 'capitanes_array','tipo_barcos'));
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
        $embarcacion -> id_tipo_barco = $request -> barco;
   
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
