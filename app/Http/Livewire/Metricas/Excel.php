<?php

namespace App\Http\Livewire\Metricas;

use Maatwebsite\Excel\Facades\Excel as ExportExcel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Exports\BitacoraExport;

class Excel extends Component
{

    public $bitacora = false, $lance = false, $especie = false;
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
           $descartada;

    public function render()
    {
        return view('livewire.metricas.excel');
    }

    public function exportar(){

        $especies = DB::table('bitacora');
        $encabezado = array();
         
        //Bitacora
           if($this -> embarcacion_nombre){
               $especies -> addSelect('embarcacion.Nombre as Embarcacion_Nombre');
               $this -> bitacora = true;

               $encabezado[] = 'Nombre de Embarcacion';
           }    
   
           if($this -> embarcacion_matricula){
               $especies -> addSelect('embarcacion.Matricula');
               $this -> bitacora = true;

               $encabezado[] = 'Matricula de la Embarcacion';
           }    
           
           if($this -> capitan){
               $especies -> addSelect('capitan.nombres as Nombre_Capitan', 'capitan.apellidos as Apellido_Capitan');
               $this -> bitacora = true;

               $encabezado[] = 'Nombre del Capitan';
               $encabezado[] = 'Apellido del Capitan';
           }
           
           if($this -> fecha_inicial){
               $especies -> addSelect('bitacora.fecha_inicial as Fecha');
               $this -> bitacora = true;

               $encabezado[] = 'Fecha';
           }
           
           if($this -> puerto_zarpe){
               $especies -> addSelect('puerto.nombre as Puerto_Zarpe');
               $this -> bitacora = true;

               $encabezado[] = 'Puerto de Zarpe';
           }

           if($this -> nro_bitacora){
               $especies -> addSelect('bitacora.nombre as Nro_Bitacora');
               $this -> bitacora = true;

               $encabezado[] = 'Nº Bitacora';
           }

           if($this -> observaciones){
               $especies -> addSelect('bitacora.observaciones as Observaciones');
               $this -> bitacora = true;

               $encabezado[] = 'Observaciones';
           }

           if($this -> millas_recorridas){
               $especies -> addSelect('bitacora.millas_recogidas as Millas_Recorridas');
               $this -> bitacora = true;

               $encabezado[] = 'Millas Recorridas';
           }

           if($this -> produccion_total){
               $especies -> addSelect('bitacora.produccion as Produccion_Total');
               $this -> bitacora = true;

               $encabezado[] = 'Produccion Total';
           }

           if($this -> combustible){
               $especies -> addSelect('bitacora.combustible as Combustible');
               $this -> bitacora = true;

               $encabezado[] = 'Combustible';
           }
        //Bitacora end    

        //Lance

           if($this -> nro_lance){
               $especies -> addSelect('lances.nombre as Nro_Lance');
               $this -> lance = true;

               $encabezado[] = 'Nº Lance';
           }
   
           if($this -> mitigacion_bycatch){
               $especies -> addSelect('lances.mitigacion as Mitigacion_Bycatch');
               $this -> lance = true;

               $encabezado[] = 'Mitigacion Bycatch';
           }
   
           if($this -> temperatura){
               $especies -> addSelect('lances.temperatura as Temperatura');
               $this -> lance = true;

               $encabezado[] = 'Temperatura';
           }
   
           if($this -> dispositivo_selectividad){
               $especies -> addSelect('lance_arte_de_pesca.nombre_dispositivo as nombre_dispositivo');
               $this -> lance = true;

               $encabezado[] = 'Nombre dispositivo';
           }
   
           if($this -> coordenadas){
               $especies -> addSelect('coordenadas.latitud as Latitud', 'coordenadas.latitud as Longitud');
               $this -> lance = true;

               $encabezado[] = 'Latitud';
               $encabezado[] = 'Longitud';
           }

        //Lance end

        // Especies

           if($this -> retenida || $this -> descartada){
               $especies -> addSelect('especies.nombre as Nombre_Especie', 'especies.nombre_cientifico as Nombre_Científico'); 
               $this -> especie = true;
           }
           if($this -> incidental){
               $especies -> addSelect('especies.nombre as Nombre_Especie', 'especies.nombre_cientifico as Nombre_Científico');
               $especies -> orWhere('especie_lance.id_tipo', '=', 2);
               $this -> especie = true;
           }

           if($this -> retenida || $this -> descartada || $this -> incidental){
             $encabezado[] = 'Nombre Científico';
             $encabezado[] = 'Nombre Especie';
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
                       ->join('especies', 'especie_lance.id_especie', '=', 'especies.id');
        }


         //$especies -> select('capitan.nombres', 'especies.nombre', 'especies.nombre_cientifico', 'especie_lance.id_tipo', 'kilogramos', 'unidades') ->where('especie_lance.id_armador', auth()->user() -> id);

         if($this -> retenida ){
            $especies -> where('especie_lance.id_tipo', 1);
          }
        if($this -> incidental){
             $especies -> where('especie_lance.id_tipo', 2);
         }
         if($this -> descartada){
             $especies -> where('especie_lance.id_tipo', 3);
         }

         $especies ->where('capitan.id_armador', auth()->user() -> id);
         $datos =  $especies ->get();

        
          return ExportExcel::download(new BitacoraExport($datos,   $encabezado), 'planilla.xlsx');
          return dd( $datos);
    }

}
