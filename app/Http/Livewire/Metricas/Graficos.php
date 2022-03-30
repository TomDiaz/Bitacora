<?php

namespace App\Http\Livewire\Metricas;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Graficos extends Component
{
    public $datos, $tipo1, $tipo2 , $dato1, $dato2, $tipo_grafico, $desde, $hasta;
    public $retenidas=0, $incidentales=0, $descarte=0;
    public $tags = array();
    public $grafico = false;

    public function __construct() {
        

        $this -> datos = [

            0 => [
                'nombre' => 'Nombre de la embarcación',
                'id' => 0
            ],

            1 => [
                'nombre' => 'Nombre del capitán',
                'id' => 1
            ],
            2 => [
                'nombre' => 'Nombre de especie (Normal)',
                'id' => 2
            ],
            3 => [
                'nombre' => 'Nombre de especie (Científico)',
                'id' => 3
            ],
            4 => [
                'nombre' => 'Talla/Tamaño',
                'id' => 4
            ],
            5 => [
                'nombre' => 'Combustible',
                'id' => 5
            ],
            6 => [
                'nombre' => 'Millas recorridas ',
                'id' => 6
            ]
         ];

         


    }

    public function mostrarGrafico(){
        $this -> grafico = true;
    }

    public function render(Request $req)
    {
        return view('livewire.metricas.graficos');
    }

    public function ocultar(){
        $this -> grafico = false;
    }

    public function mostar(){

        $this -> grafico = true;

        $this -> retenidas = 0;
        $this -> incidentales = 0;
        $this -> descarte = 0;


         $especies = DB::table('bitacora')
            ->join('lances', 'bitacora.id', '=', 'lances.id_bitacora')
            ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
            ->join('capitan', 'bitacora.id_capitan', '=', 'capitan.id')
            ->join('especie_lance', 'lances.id', '=', 'especie_lance.id_lance')
            ->join('especies', 'especie_lance.id_especie', '=', 'especies.id')
            ->select('embarcacion.Nombre', 'capitan.nombres', 'especies.nombre', 'especies.nombre_cientifico', 'especie_lance.id_tipo', 'kilogramos', 'unidades')
            ->where('especie_lance.id_armador', auth()->user() -> id);
            

            //FILTRO DATO 1
            if( $this -> dato1 &&  $this ->tipo1 == 0 ){
                $especies ->where('embarcacion.Nombre','LIKE','%'.  $this -> dato1 .'%');
            }

            if( $this -> dato1 &&  $this ->tipo1 == 1 ){
                $especies ->where('capitan.nombres','LIKE','%'.  $this -> dato1 .'%');
            }

            if( $this -> dato1 &&  $this ->tipo1 == 2 ){
                $especies ->where('especies.nombre','LIKE','%'.  $this -> dato1 .'%');
            }

            if( $this -> dato1 &&  $this ->tipo1 == 3 ){
                $especies ->where('especies.nombre_cientifico','LIKE','%'.  $this -> dato1 .'%');
            }

            if( $this -> dato1 &&  $this ->tipo1 == 4 ){
                $especies ->where('especie_lance.talla_tamanio', $this -> dato1);
            }

            if( $this -> dato1 &&  $this ->tipo1 == 5 ){
                $especies ->where('bitacora.combustible', $this -> dato1);
            }

            if( $this -> dato1 &&  $this ->tipo1 == 6 ){
                $especies ->where('bitacora.millas_recogidas', $this -> dato1);
            }

            //FILTRO DATO 2
            if($this -> dato2 &&  $this -> tipo2 == 0 ){
                $especies ->where('embarcacion.Nombre','LIKE','%'. $this -> dato2 .'%');
            }

            if($this -> dato2 &&  $this -> tipo2 == 1 ){
                $especies ->where('capitan.nombres','LIKE','%'. $this -> dato2 .'%');
            }

            if($this -> dato2 &&  $this -> tipo2 == 2 ){
                $especies ->where('especies.nombre','LIKE','%'. $this -> dato2 .'%');
            }

            if($this -> dato2 &&  $this -> tipo2 == 3 ){
                $especies ->where('especies.nombre_cientifico','LIKE','%'. $this -> dato2 .'%');
            }

            if($this -> dato2 &&  $this -> tipo2 == 4 ){
                $especies ->where('especie_lance.talla_tamanio',$this -> dato2);
            }

            if($this -> dato2 &&  $this -> tipo2 == 5 ){
                $especies ->where('bitacora.combustible',$this -> dato2);
            }

            if($this -> dato2 &&  $this -> tipo2 == 6 ){
                $especies ->where('bitacora.millas_recogidas',$this -> dato2);
            }

            //Desde a Hasta 
            if($this -> desde){
                $especies ->where('lances.fecha_inicial', '>=',$this -> desde);
            }
            if($this -> hasta){
                $especies ->where('lances.fecha_inicial','<=',$this -> hasta);
            }

         $resultados =  $especies ->get();

        ///Conteno resultados de las especies    
        foreach($resultados  as $especie){


            switch( $especie -> id_tipo) {

                case 1:
                    $this -> retenidas += $especie -> kilogramos;
                break;
                case 2:
                    $this -> incidentales += $especie -> unidades;
                break;
                case 3:
                    $this -> descarte += $especie -> kilogramos;
                break;

            }

        }    


        $this->dispatchBrowserEvent('contentChanged');


    }


}
