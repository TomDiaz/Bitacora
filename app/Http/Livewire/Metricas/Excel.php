<?php

namespace App\Http\Livewire\Metricas;

use Maatwebsite\Excel\Facades\Excel as ExportExcel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Exports\BitacoraExport;
use App\Http\Resources\BitacoraResource;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\FuncCall;

class Excel extends Component
{

    protected $cabecera = array();
    protected $especies_check = array();
    public $bitacora = false, $lance = false, $especie = false, $desde, $hasta, $valido;
    public $embarcacion_nombre, 
           $embarcacion_matricula,
           $capitan,
           $fecha_inicial,
           $puerto_zarpe,
           $puerto_desembarque,
           $dispositivo_selectividad,
           $mitigacion_bycatch,
           $viento,
           $temperatura,
           $observaciones_generales,
           $observaciones_parte_de_pesca,
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
           $descartada,
           $anio,
           $pesca_incidental,
           $prospeccion,
           $observador_a_bordo,
           $n_tripulantes,
           $fecha_hora_zarpe,
           $fecha_hora_desembarque,
           $subarea,
           $zona_pesca,
           $marea;

    public function render()
    {
        return view('livewire.metricas.excel');
    }


    public function exportar(){

        $data = array();
        $data_procesada = array();

        if($this -> desde && $this -> hasta){
          $bitacora = DB::table('bitacora')
                      ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
                      -> where('bitacora.fecha_inicial', '>=' , $this -> desde )
                      ->where('bitacora.fecha_inicial', '<=' , $this -> hasta )
                      ->where('IdArmador', auth()->user() -> id)
                      ->get();
       }
       else{
          $bitacora = DB::table('bitacora')
                      ->join('embarcacion', 'bitacora.id_embarcacion', '=', 'embarcacion.IdEmbarcacion')
                      ->where('IdArmador', auth()->user() -> id)
                      ->get();
       }
       

      

        $coleccion =   BitacoraResource::collection($bitacora);

        foreach( $coleccion  as $item){
            $data[] =  json_decode(json_encode($item), true);
        }

        $this -> check();

        $vuelta = 0;

        foreach($data as $bitacora){  //CAPA BITACORA
          
              if($this -> bitacora){
                $vuelta++;
                $data_procesada[] = [
                  //Bitacora
                 'Nº de bitacora' => $this -> nro_bitacora ? $this -> newCabecera($bitacora['nombre'],  'Nº de bitacora', $vuelta)  : null,
                 'Embarcación - Nombre' => $this -> embarcacion_nombre ?  $this -> newCabecera($bitacora['embarcacion'], 'Embarcación - Nombre', $vuelta) : null,
                 'Embarcación - Matrícula' => $this -> embarcacion_matricula ?  $this -> newCabecera($bitacora['matricula'],  'Embarcación - Matrícula', $vuelta)  : null,
                 'Capitán - Nombre y Apellido' =>  $this -> capitan  ?  $this -> newCabecera($bitacora['capitan'],  'Capitán - Nombre y Apellido', $vuelta)  : null,
                 'Capitán - CUIL' =>  $this -> cuil ?   $this -> newCabecera($bitacora['capitan_cuil'], 'Capitán - CUIL', $vuelta) : null,
                 'N° de tripulantes' => $this -> n_tripulantes ?  $this -> newCabecera($bitacora['tripulantes'], 'N° de tripulantes', $vuelta) : null,
                 'Fecha' => $this -> fecha_inicial ?  $this -> newCabecera(date("d/m/Y", strtotime($bitacora['fecha_inicial'])),'Fecha', $vuelta) : null,
                 'Año' => $this -> anio ? $this -> newCabecera(date("Y", strtotime($bitacora['fecha_inicial'])),'Año', $vuelta) : null,
                 'Marea' => $this -> marea ?  $this -> newCabecera($bitacora['marea'], 'Marea', $vuelta) : null,
                 'Puerto de zarpe' => $this -> puerto_zarpe ?  $this -> newCabecera($bitacora['puerto_zarpe'], 'Puerto de zarpe', $vuelta) : null,
                 'Puerto de desembarque' => $this -> puerto_desembarque ?  $this -> newCabecera($bitacora['puerto_arribo'], 'Puerto de desembarque', $vuelta) : null,
                 'Millas recorridas' =>  $this -> millas_recorridas ?  $this -> newCabecera($bitacora['millas_recogidas'], 'Millas recorridas', $vuelta) : null,
                 'Combustible' => $this -> combustible ?  $this -> newCabecera($bitacora['combustible'],'Combustible', $vuelta) : null,
                 'Producción total' =>  $this -> produccion_total ?   $this -> newCabecera($bitacora['produccion'],'Producción total', $vuelta) : null,
                 'Observaciones generales' =>  $this -> observaciones_generales ? $this -> newCabecera($bitacora['observaciones_generales'],'Observaciones generales', $vuelta) : null,
                 'Observaciones parte de pesca' => $this -> observaciones_parte_de_pesca ?  $this -> newCabecera($bitacora['observacion_parte_pesca'],'Observaciones parte de pesca', $vuelta) : null,
                 'Prospección' =>  $this -> prospeccion ? $this -> newCabecera($bitacora['prospeccion'],'Prospección',$vuelta) : null,
                 'Observador a bordo' => $this -> observador_a_bordo ?  $this -> newCabecera($bitacora['observador_a_bordo'],'Observador a bordo', $vuelta) : null,
                 'Mitigación bycatch' => $this -> mitigacion_bycatch ? $this -> newCabecera($bitacora['mitigacion'],'Mitigación bycatch', $vuelta) : null,
                 'Fecha y hora de zarpe' =>  $this -> fecha_hora_zarpe ?  $this -> newCabecera($bitacora['fecha_inicial'],'Fecha y hora de zarpe', $vuelta) : null,
                 'Fecha y hora de desembarque' =>  $this -> fecha_hora_desembarque ?  $this -> newCabecera($bitacora['fecha_final'],'Fecha y hora de desembarque', $vuelta) : null,
                 'Subárea' =>  $this -> subarea ? $this -> newCabecera($bitacora['subarea'],'Subárea', $vuelta) : null,
                 'Zona de pesca' => $this -> zona_pesca ?  $this -> newCabecera($bitacora['zona_pesca'],'Zona de pesca', $vuelta) : null,
                 'Nombre dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['nombre_dispositivo'],'Nombre dispositivo', $vuelta) : null,
                 'Tamaño dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tamanio'],'Tamaño dispositivo', $vuelta) : null,
                 'Tipo de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tipo_malla'],'Tipo de malla', $vuelta) : null,
                 'Luz de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['luz_malla'],'Luz de malla', $vuelta) : null,
                  
               ];

              }

           foreach($bitacora['lances'] as $lance){ //CAPA LANCES

                 if($this -> lance){
                    $vuelta++;
                   $data_procesada[] = [
                    //Bitacora
                   'Nº de bitacora' => $this -> nro_bitacora ? $this -> newCabecera($bitacora['nombre'],  'Nº de bitacora', $vuelta)  : null,
                   'Embarcación - Nombre' => $this -> embarcacion_nombre ?  $this -> newCabecera($bitacora['embarcacion'], 'Embarcación - Nombre', $vuelta) : null,
                   'Embarcación - Matrícula' => $this -> embarcacion_matricula ?  $this -> newCabecera($bitacora['matricula'],  'Embarcación - Matrícula', $vuelta)  : null,
                   'Capitán - Nombre y Apellido' =>  $this -> capitan  ?  $this -> newCabecera($bitacora['capitan'],  'Capitán - Nombre y Apellido', $vuelta)  : null,
                   'Capitán - CUIL' =>  $this -> cuil ?   $this -> newCabecera($bitacora['capitan_cuil'], 'Capitán - CUIL', $vuelta) : null,
                   'N° de tripulantes' => $this -> n_tripulantes ?  $this -> newCabecera($bitacora['tripulantes'], 'N° de tripulantes', $vuelta) : null,
                   'Fecha' => $this -> fecha_inicial ?  $this -> newCabecera(date("d/m/Y", strtotime($bitacora['fecha_inicial'])),'Fecha', $vuelta) : null,
                   'Año' => $this -> anio ? $this -> newCabecera(date("Y", strtotime($bitacora['fecha_inicial'])),'Año', $vuelta) : null,
                   'Marea' => $this -> marea ?  $this -> newCabecera($bitacora['marea'], 'Marea', $vuelta) : null,
                   'Puerto de zarpe' => $this -> puerto_zarpe ?  $this -> newCabecera($bitacora['puerto_zarpe'], 'Puerto de zarpe', $vuelta) : null,
                   'Puerto de desembarque' => $this -> puerto_desembarque ?  $this -> newCabecera($bitacora['puerto_arribo'], 'Puerto de desembarque', $vuelta) : null,
                   'Millas recorridas' =>  $this -> millas_recorridas ?  $this -> newCabecera($bitacora['millas_recogidas'], 'Millas recorridas', $vuelta) : null,
                   'Combustible' => $this -> combustible ?  $this -> newCabecera($bitacora['combustible'],'Combustible', $vuelta) : null,
                   'Producción total' =>  $this -> produccion_total ?   $this -> newCabecera($bitacora['produccion'],'Producción total', $vuelta) : null,
                   'Observaciones generales' =>  $this -> observaciones_generales ? $this -> newCabecera($bitacora['observaciones_generales'],'Observaciones generales', $vuelta) : null,
                   'Observaciones parte de pesca' => $this -> observaciones_parte_de_pesca ?  $this -> newCabecera($bitacora['observacion_parte_pesca'],'Observaciones parte de pesca', $vuelta) : null,
                   'Prospección' =>  $this -> prospeccion ? $this -> newCabecera($bitacora['prospeccion'],'Prospección', $vuelta) : null,
                   'Observador a bordo' => $this -> observador_a_bordo ?  $this -> newCabecera($bitacora['observador_a_bordo'],'Observador a bordo', $vuelta) : null,
                   'Mitigación bycatch' => $this -> mitigacion_bycatch ? $this -> newCabecera($bitacora['mitigacion'],'Mitigación bycatch', $vuelta) : null,
                   'Fecha y hora de zarpe' =>  $this -> fecha_hora_zarpe ?  $this -> newCabecera($bitacora['fecha_inicial'],'Fecha y hora de zarpe', $vuelta) : null,
                   'Fecha y hora de desembarque' =>  $this -> fecha_hora_desembarque ?  $this -> newCabecera($bitacora['fecha_final'],'Fecha y hora de desembarque', $vuelta) : null,
                   'Subárea' =>  $this -> subarea ? $this -> newCabecera($bitacora['subarea'],'Subárea', $vuelta) : null,
                   'Zona de pesca' => $this -> zona_pesca ?  $this -> newCabecera($bitacora['zona_pesca'],'Zona de pesca', $vuelta) : null,
                   'Nombre dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['nombre_dispositivo'],'Nombre dispositivo', $vuelta) : null,
                   'Tamaño dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tamanio'],'Tamaño dispositivo', $vuelta) : null,
                   'Tipo de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tipo_malla'],'Tipo de malla', $vuelta) : null,
                   'Luz de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['luz_malla'],'Luz de malla', $vuelta) : null,

                    //Lance
                    'Nº Lance' => $this -> nro_lance ? $this -> newCabecera($lance['nombre'],'Nº Lance', $vuelta) : null,
                    'Temperatura' => $this -> temperatura ? $this -> newCabecera($lance['temperatura'],'Temperatura', $vuelta) : null,
                    'Viento' =>  $this -> viento ?  $this -> newCabecera($lance['viento'],'Viento', $vuelta) : null,
                    'Coordenadas Inicio' => $this -> coordenadas ?  $this -> newCabecera($lance['coordenadas'][0]['latitud'] . ' - ' . $lance['coordenadas'][0]['longitud'] ,'Coordenadas Inicio',$vuelta) : null,
                    'Coordenadas Fin' => $this -> coordenadas ?  $this -> newCabecera($lance['coordenadas'][1]['latitud'] . ' - ' . $lance['coordenadas'][1]['longitud'] ,'Coordenadas Fin',$vuelta) : null,
                  ];

                 }

               foreach($lance['especies'] as $especie){ //CAPA ESPECIES
                    
                    if($this -> especie && $this -> especieFilter($especie['id_tipo'])){
                        $vuelta++;
                      $data_procesada[] = [
                         //Bitacora
                        'Nº de bitacora' => $this -> nro_bitacora ? $this -> newCabecera($bitacora['nombre'],  'Nº de bitacora', $vuelta)  : null,
                        'Embarcación - Nombre' => $this -> embarcacion_nombre ?  $this -> newCabecera($bitacora['embarcacion'], 'Embarcación - Nombre', $vuelta) : null,
                        'Embarcación - Matrícula' => $this -> embarcacion_matricula ?  $this -> newCabecera($bitacora['matricula'],  'Embarcación - Matrícula', $vuelta)  : null,
                        'Capitán - Nombre y Apellido' =>  $this -> capitan  ?  $this -> newCabecera($bitacora['capitan'],  'Capitán - Nombre y Apellido', $vuelta)  : null,
                        'Capitán - CUIL' =>  $this -> cuil ?   $this -> newCabecera($bitacora['capitan_cuil'], 'Capitán - CUIL', $vuelta) : null,
                        'N° de tripulantes' => $this -> n_tripulantes ?  $this -> newCabecera($bitacora['tripulantes'], 'N° de tripulantes', $vuelta) : null,
                        'Fecha' => $this -> fecha_inicial ?  $this -> newCabecera(date("d/m/Y", strtotime($bitacora['fecha_inicial'])),'Fecha', $vuelta) : null,
                        'Año' => $this -> anio ? $this -> newCabecera(date("Y", strtotime($bitacora['fecha_inicial'])),'Año', $vuelta) : null,
                        'Marea' => $this -> marea ?  $this -> newCabecera($bitacora['marea'], 'Marea', $vuelta) : null,
                        'Puerto de zarpe' => $this -> puerto_zarpe ?  $this -> newCabecera($bitacora['puerto_zarpe'], 'Puerto de zarpe', $vuelta) : null,
                        'Puerto de desembarque' => $this -> puerto_desembarque ?  $this -> newCabecera($bitacora['puerto_arribo'], 'Puerto de desembarque', $vuelta) : null,
                        'Millas recorridas' =>  $this -> millas_recorridas ?  $this -> newCabecera($bitacora['millas_recogidas'], 'Millas recorridas', $vuelta) : null,
                        'Combustible' => $this -> combustible ?  $this -> newCabecera($bitacora['combustible'],'Combustible', $vuelta) : null,
                        'Producción total' =>  $this -> produccion_total ?   $this -> newCabecera($bitacora['produccion'],'Producción total', $vuelta) : null,
                        'Observaciones generales' =>  $this -> observaciones_generales ? $this -> newCabecera($bitacora['observaciones_generales'],'Observaciones generales', $vuelta) : null,
                        'Observaciones parte de pesca' => $this -> observaciones_parte_de_pesca ?  $this -> newCabecera($bitacora['observacion_parte_pesca'],'Observaciones parte de pesca', $vuelta) : null,
                        'Prospección' =>  $this -> prospeccion ? $this -> newCabecera($bitacora['prospeccion'],'Prospección', $vuelta) : null,
                        'Observador a bordo' => $this -> observador_a_bordo ?  $this -> newCabecera($bitacora['observador_a_bordo'],'Observador a bordo', $vuelta) : null,
                        'Mitigación bycatch' => $this -> mitigacion_bycatch ? $this -> newCabecera($bitacora['mitigacion'],'Mitigación bycatch', $vuelta) : null,
                        'Fecha y hora de zarpe' =>  $this -> fecha_hora_zarpe ?  $this -> newCabecera($bitacora['fecha_inicial'],'Fecha y hora de zarpe', $vuelta) : null,
                        'Fecha y hora de desembarque' =>  $this -> fecha_hora_desembarque ?  $this -> newCabecera($bitacora['fecha_final'],'Fecha y hora de desembarque', $vuelta) : null,
                        'Subárea' =>  $this -> subarea ? $this -> newCabecera($bitacora['subarea'],'Subárea', $vuelta) : null,
                        'Zona de pesca' => $this -> zona_pesca ?  $this -> newCabecera($bitacora['zona_pesca'],'Zona de pesca', $vuelta) : null,
                        'Nombre dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['nombre_dispositivo'],'Nombre dispositivo', $vuelta) : null,
                        'Tamaño dispositivo' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tamanio'],'Tamaño dispositivo', $vuelta) : null,
                        'Tipo de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['tipo_malla'],'Tipo de malla', $vuelta) : null,
                        'Luz de malla' => $this -> dispositivo_selectividad ?  $this -> newCabecera($bitacora['arte_pesca'][0]['luz_malla'],'Luz de malla', $vuelta) : null,

                        //Lance
                        'Nº Lance' => $this -> nro_lance ? $this -> newCabecera($lance['nombre'],'Nº Lance', $vuelta) : null,
                        'Temperatura' => $this -> temperatura ? $this -> newCabecera($lance['temperatura'],'Temperatura', $vuelta) : null,
                        'Viento' =>  $this -> viento ?  $this -> newCabecera($lance['viento'],'Viento', $vuelta) : null,
                        'Coordenadas Inicio' => $this -> coordenadas ?  $this -> newCabecera($lance['coordenadas'][0]['latitud'] . ' - ' . $lance['coordenadas'][0]['longitud'] ,'Coordenadas Inicio',$vuelta) : null,
                        'Coordenadas Fin' => $this -> coordenadas ?  $this -> newCabecera($lance['coordenadas'][1]['latitud'] . ' - ' . $lance['coordenadas'][1]['longitud'] ,'Coordenadas Fin',$vuelta) : null,
                             
                         //Especie
                        'Nombre común' => $this -> newCabecera($especie['nombre'],'Nombre común',$vuelta),
                        'Nombre científico' =>  $this -> newCabecera($especie['nombre_cientifico'],'Nombre científico',$vuelta),
                        'kg' => $this -> newCabecera($especie['kilogramos'],'kg',$vuelta),
                        'Cajones' => $this -> newCabecera($especie['cajones'],'Cajones',$vuelta),
                        'Unidades' => $this -> newCabecera($especie['unidades'],'Unidades',$vuelta),
                        'Talla' => $this -> newCabecera($especie['talla_tamanio'],'Talla',$vuelta),
                        'Tipo de especie' => $this -> newCabecera($especie['tipo'],'Tipo de especie',$vuelta),
                      ];
                    }

               }
            
           }

        }

        if($this -> valido == 1){
            return ExportExcel::download(new BitacoraExport(collect( $this -> dataFilter($data_procesada)), $this -> cabecera), 'planilla.xlsx');
        }

        session()->flash('message', 'Debe elejir al menos un dato a exportar.');
    }


    public function dataFilter($data_procesada){

        $data_final = array();
     
        foreach($data_procesada as $data){
          
          $data_aux = array();

          foreach($this -> cabecera as $header)
          {
            $data_aux[] = $data[$header];
          }

          $data_final[] = $data_aux;

        }
      
        return  $data_final;
    }

    public function especieFilter($especie){

        foreach($this -> especies_check as $tipo){
            if($especie == $tipo){
                return true;
            }
        }

        return false;
    }


    public function newCabecera($valor, $cab, $vuelta){
        if($vuelta == 1){
            $this -> cabecera[] = $cab;
        }
       return $valor;
    }

    public function check(){


        $this -> valido = 0;
        $this -> lance = false;
        $this -> especie = false;
        $this -> bitacora = false;
        
        //Bitacora
           if( $this -> embarcacion_nombre || 
               $this -> embarcacion_matricula ||
               $this -> capitan ||
               $this -> cuil ||
               $this -> fecha_inicial ||
               $this -> puerto_zarpe ||
               $this -> puerto_desembarque ||
               $this -> nro_bitacora ||
               $this -> marea ||
               $this -> observaciones_generales || 
               $this -> observaciones_parte_de_pesca ||
               $this -> millas_recorridas ||
               $this -> produccion_total ||
               $this -> combustible ||
               $this -> prospeccion ||
               $this -> observador_a_bordo ||
               $this -> n_tripulantes ||
               $this -> fecha_hora_zarpe ||
               $this -> fecha_hora_desembarque ||
               $this -> subarea ||
               $this -> zona_pesca ||
               $this -> mitigacion_bycatch ||
               $this -> anio ||
               $this -> dispositivo_selectividad
            ){
               $this -> bitacora = true;
               $this -> valido = 1;
           }    

        //Lance

           if(
               $this -> nro_lance ||
               $this -> viento ||
               $this -> temperatura ||
               $this -> coordenadas
            ){
                $this -> bitacora = false;
               $this -> lance = true;
               $this -> valido = 1;
           }

        // Especies

           if($this -> retenida || $this -> descartada || $this -> incidental || $this -> pesca_incidental){
               $this -> bitacora = false;
               $this -> lance = false;
               $this -> especie = true;
               $this -> valido = 1;
           }

           if($this -> retenida){
             $this -> especies_check[] = 1;
           }

           if($this -> incidental){
             $this -> especies_check[] = 2;
           }

           if($this -> descartada){
             $this -> especies_check[] = 3;
           }

           if($this -> pesca_incidental){
             $this -> especies_check[] = 4;
           }

    }

    public function all(){
        
        $this -> embarcacion_nombre = true;
        $this -> embarcacion_matricula = true;
        $this -> capitan = true;
        $this -> fecha_inicial = true;
        $this -> puerto_zarpe = true;
        $this -> puerto_desembarque = true;
        $this -> dispositivo_selectividad = true;
        $this -> mitigacion_bycatch = true;
        $this -> viento = true;
        $this -> temperatura = true;
        $this -> observaciones_generales = true;
        $this -> observaciones_parte_de_pesca = true;
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
        $this -> anio = true;
        $this -> pesca_incidental = true;
$this -> prospeccion = true;
$this -> observador_a_bordo = true;
$this -> n_tripulantes = true;
$this -> fecha_hora_zarpe = true;
$this -> fecha_hora_desembarque = true;
$this -> subarea = true;
$this -> zona_pesca = true;
        $this -> marea = true;
    }

    public function none(){
        
        $this -> embarcacion_nombre = false;
        $this -> embarcacion_matricula = false;
        $this -> capitan = false;
        $this -> fecha_inicial = false;
        $this -> puerto_zarpe = false;
        $this -> puerto_desembarque = false;
        $this -> dispositivo_selectividad = false;
        $this -> mitigacion_bycatch = false;
        $this -> viento = false;
        $this -> temperatura = false;
        $this -> observaciones_generales = false;
        $this -> observaciones_parte_de_pesca = false;
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
        $this -> anio = false;
        $this -> pesca_incidental = false;
        $this -> marea = false;
        $this -> prospeccion = false;
        $this -> observador_a_bordo = false;
        $this -> n_tripulantes = false;
        $this -> fecha_hora_zarpe = false;
        $this -> fecha_hora_desembarque = false;
        $this -> subarea = false;
        $this -> zona_pesca = false;
    }

}
