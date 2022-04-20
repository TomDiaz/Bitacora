<?php

namespace App\Http\Livewire\Metricas;

use Maatwebsite\Excel\Facades\Excel as ExportExcel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Exports\BitacoraExport;

class Excel extends Component
{

    public $bitacora = false, $lance = false, $especie = false, $desde, $hasta, $valido;
    public $embarcacion_nombre, 
           $embarcacion_matricula,
           $capitan,
           $fecha_inicial,
           $puerto_zarpe,
           $dispositivo_selectividad,
           $mitigacion_bycatch,
           $viento,
           $temperatura,
           $observaciones,
           $nro_bitacora,
           $combustible,
           $millas_recorridas,
           $produccion_total,
           $total_captura_retenida,
           $nro_lance,
           $coordenadas,
           $retenida,
           $incidental,
           $cuil,
           $descartada;

    public function render()
    {
        return view('livewire.metricas.excel');
    }

    public function exportar(){

        $especies = DB::table('bitacora');
        $encabezado = array();

        $this -> valido = 0;
         
        //Bitacora
           if($this -> embarcacion_nombre){
               $especies -> addSelect('embarcacion.Nombre as Embarcacion_Nombre');
               $this -> bitacora = true;

               $encabezado[] = 'Nombre de la embarcación';
               $this -> valido = 1;
           }    
   
           if($this -> embarcacion_matricula){
               $especies -> addSelect('embarcacion.Matricula');
               $this -> bitacora = true;

               $encabezado[] = 'Matrícula de la embarcación';
               $this -> valido = 1;
           }    
           
           if($this -> capitan){
               $especies -> addSelect('capitan.nombres as Nombre_Capitan', 'capitan.apellidos as Apellido_Capitan');
               $this -> bitacora = true;

               $encabezado[] = 'Nombre del capitán';
               $encabezado[] = 'Apellido del capitán';
               $this -> valido = 1;
           }

           if($this -> cuil){
               $especies -> addSelect('capitan.cuil');
               $this -> bitacora = true;

               $encabezado[] = 'Cuil del capitán';
               $this -> valido = 1;
           }
           
           if($this -> fecha_inicial){
               $especies -> addSelect('bitacora.fecha_inicial as Fecha');
               $this -> bitacora = true;

               $encabezado[] = 'Fecha';
               $this -> valido = 1;
           }
           
           if($this -> viento){
               $especies -> addSelect('bitacora.viento');
               $this -> bitacora = true;

               $encabezado[] = 'Viento';
               $this -> valido = 1;
           }
           
           if($this -> puerto_zarpe){
               $especies -> addSelect('puerto.nombre as Puerto_Zarpe');
               $this -> bitacora = true;

               $encabezado[] = 'Puerto de Zarpe';
               $this -> valido = 1;
           }

           if($this -> nro_bitacora){
               $especies -> addSelect('bitacora.nombre as Nro_Bitacora');
               $this -> bitacora = true;

               $encabezado[] = 'Nº bitácora';
               $this -> valido = 1;
           }

           if($this -> observaciones){
               $especies -> addSelect('bitacora.observaciones as Observaciones');
               $this -> bitacora = true;

               $encabezado[] = 'Observaciones';
               $this -> valido = 1;
           }

           if($this -> millas_recorridas){
               $especies -> addSelect('bitacora.millas_recogidas as Millas_Recorridas');
               $this -> bitacora = true;

               $encabezado[] = 'Millas Recorridas';
               $this -> valido = 1;
           }

           if($this -> produccion_total){
               $especies -> addSelect('bitacora.produccion as Produccion_Total');
               $this -> bitacora = true;

               $encabezado[] = 'Producción total';
               $this -> valido = 1;
           }

           if($this -> combustible){
               $especies -> addSelect('bitacora.combustible as Combustible');
               $this -> bitacora = true;

               $encabezado[] = 'Combustible';
               $this -> valido = 1;
           }
        //Bitacora end    

        //Lance

           if($this -> nro_lance){
               $especies -> addSelect('lances.nombre as Nro_Lance');
               $this -> lance = true;

               $encabezado[] = 'Nº Lance';
               $this -> valido = 1;
           }
   
           if($this -> mitigacion_bycatch){
               $especies -> addSelect('lances.mitigacion as Mitigacion_Bycatch');
               $this -> lance = true;

               $encabezado[] = 'Mitigación bycatch';
               $this -> valido = 1;
           }
   
           if($this -> temperatura){
               $especies -> addSelect('lances.temperatura as Temperatura');
               $this -> lance = true;

               $encabezado[] = 'Temperatura';
               $this -> valido = 1;
           }
   
           if($this -> dispositivo_selectividad){
               $especies -> addSelect('lance_arte_de_pesca.nombre_dispositivo as nombre_dispositivo', 'lance_arte_de_pesca.tamanio', 'lance_arte_de_pesca.tipo_malla', 'lance_arte_de_pesca.luz_malla');
               $this -> lance = true;

               $encabezado[] = 'Nombre dispositivo';
               $encabezado[] = 'Tamaño dispositivo';
               $encabezado[] = 'Tipo de malla';
               $encabezado[] = 'Luz de malla';

               $this -> valido = 1;
           }
   
           if($this -> coordenadas){
               $especies -> addSelect('coordenadas.latitud as Latitud', 'coordenadas.longitud as Longitud');
               $this -> lance = true;

               $encabezado[] = 'Latitud';
               $encabezado[] = 'Longitud';
               $this -> valido = 1;
           }

        //Lance end

        // Especies

           $especies_cont = array();
           $valores_tipo = [1,2,3];

           if($this -> retenida || $this -> descartada || $this -> incidental){
               $especies -> addSelect('especies.nombre as Nombre_Especie', 'especies.nombre_cientifico as Nombre_Científico','especie_lance.kilogramos', 'especie_lance.cajones', 'especie_lance.unidades', 'tipo_de_especie.nombre as Tipo'); 
               $this -> especie = true;

               $encabezado[] = 'Nombre común';
               $encabezado[] = 'Nombre científico';
               $encabezado[] = 'kg';
               $encabezado[] = 'Cajones';
               $encabezado[] = 'Unidades';
               $encabezado[] = 'Tipo de especie';
               $this -> valido = 1;
           }

           if($this -> retenida) {
              $especies_cont[] = 1;
              $valores_tipo[0] = null;
           }
           if($this -> incidental) {
              $especies_cont[] = 2;
              $valores_tipo[1] = null;
           }
           if($this -> descartada) {
              $especies_cont[] = 3;
              $valores_tipo[3] = null;
           }



        // Especies end

        $especies ->join('capitan', 'bitacora.id_capitan', '=', 'capitan.id');

        /// JOIN DINAMICO
        if( $this -> bitacora){
             $especies ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
                       ->join('puerto', 'bitacora.id_puerto_zarpe', '=', 'puerto.id');
        }

        if( $this -> lance){
            $especies ->join('lances', 'bitacora.id', '=', 'lances.id_bitacora')
                      ->join('lance_arte_de_pesca', 'lances.id', '=', 'lance_arte_de_pesca.id_lance')
                      ->join('coordenadas', 'lances.id', '=', 'coordenadas.id_lance');
        }

        if( $this -> especie){

            if(!$this -> lance){
                $especies  ->join('lances', 'bitacora.id', '=', 'lances.id_bitacora');
            }

            $especies  ->join('especie_lance', 'lances.id', '=', 'especie_lance.id_lance')
                       ->join('especies', 'especie_lance.id_especie', '=', 'especies.id')
                       ->join('tipo_de_especie', 'especie_lance.id_tipo', '=', 'tipo_de_especie.id');
        }


         //$especies -> select('capitan.nombres', 'especies.nombre', 'especies.nombre_cientifico', 'especie_lance.id_tipo', 'kilogramos', 'unidades') ->where('especie_lance.id_armador', auth()->user() -> id);

         if( count($especies_cont) < 3 &&  count($especies_cont) != 0){

            $expulsado = array_filter($valores_tipo, function($var){
                if($var){
                    return $var;
                }
            });
            $especies -> where('especie_lance.id_tipo', '<=' , max($especies_cont))-> where('especie_lance.id_tipo', '!=', $expulsado);
         }

         if($this -> desde && $this -> hasta){
            $especies -> where('bitacora.fecha_inicial', '>=' , $this -> desde )->where('bitacora.fecha_inicial', '<=' , $this -> hasta );
         }
      

         $especies ->where('capitan.id_armador', auth()->user() -> id);
         $datos =  $especies ->get();

         if($this -> valido == 1){

             return ExportExcel::download(new BitacoraExport($datos,   $encabezado), 'planilla.xlsx');
         }

         session()->flash('message', 'Debe elejir al menos un dato a exportar.');
          //return dd( $datos);
    }

    public function all(){
        
        $this -> embarcacion_nombre = true;
        $this -> embarcacion_matricula = true;
        $this -> capitan = true;
        $this -> fecha_inicial = true;
        $this -> puerto_zarpe = true;
        $this -> dispositivo_selectividad = true;
        $this -> mitigacion_bycatch = true;
        $this -> viento = true;
        $this -> temperatura = true;
        $this -> observaciones = true;
        $this -> nro_bitacora = true;
        $this -> combustible = true;
        $this -> millas_recorridas = true;
        $this -> produccion_total = true;
        $this -> total_captura_retenida = true;
        $this -> nro_lance = true;
        $this -> coordenadas = true;
        $this -> retenida = true;
        $this -> incidental = true;
        $this -> descartada = true;
        $this -> cuil = true;
    }

    public function none(){
        
        $this -> embarcacion_nombre = false;
        $this -> embarcacion_matricula = false;
        $this -> capitan = false;
        $this -> fecha_inicial = false;
        $this -> puerto_zarpe = false;
        $this -> dispositivo_selectividad = false;
        $this -> mitigacion_bycatch = false;
        $this -> viento = false;
        $this -> temperatura = false;
        $this -> observaciones = false;
        $this -> nro_bitacora = false;
        $this -> combustible = false;
        $this -> millas_recorridas = false;
        $this -> produccion_total = false;
        $this -> total_captura_retenida = false;
        $this -> nro_lance = false;
        $this -> coordenadas = false;
        $this -> retenida = false;
        $this -> incidental = false;
        $this -> descartada = false;
        $this -> cuil = false;
    }

}
