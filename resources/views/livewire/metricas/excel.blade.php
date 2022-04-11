<div>

@extends('adminlte::page')


@section('content_header')
@stop

@section('content')


  <div class="container-fluid metricas">

     <div class="metrica-contenido">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Datos a incluir en planilla</label>
              <div class="row">
              
              <div class="col">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="embarcacion_nombre" >
                        <label class="form-check-label" for="exampleCheck1">Embarcación - Nombre</label>
                     </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="embarcacion_matricula">
                        <label class="form-check-label" for="exampleCheck1">Embarcación - Matricula</label>
                     </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="capitan">
                        <label class="form-check-label" for="exampleCheck1">Capitán - Nombre y Apellido</label>
                     </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="fecha_inicial">
                        <label class="form-check-label" for="exampleCheck1">Fecha</label>
                     </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="puerto_zarpe">
                        <label class="form-check-label" for="exampleCheck1">Puerto de zarpe</label>
                     </div>
                      </div>
              <div class="col">
                    <div class="form-group form-check">
                           <input type="checkbox" class="form-check-input" wire:model="nro_bitacora">
                           <label class="form-check-label" for="exampleCheck1">Nº de bitácora</label>
                        </div>
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="observaciones">
                        <label class="form-check-label" for="exampleCheck1">Observaciones</label>
                     </div>

                     <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="millas_recorridas">
                     <label class="form-check-label" for="exampleCheck1">Millas recorridas</label>
                  </div>
                  <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="produccion_total">
                     <label class="form-check-label" for="exampleCheck1">Producción total</label>
                  </div>

                  <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="combustible">
                     <label class="form-check-label" for="exampleCheck1">Combustible</label>
                  </div>
                 
                   
                   
              </div>
              <div class="col">
              <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="nro_lance">
                       <label class="form-check-label" for="exampleCheck1">Nº lance</label>
                    </div>
        
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="mitigacion_bycatch">
                        <label class="form-check-label" for="exampleCheck1">Mitigación bycatch</label>
                     </div>

                  <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="temperatura">
                        <label class="form-check-label" for="exampleCheck1">Temperatura</label>
                     </div>
                     <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="viento">
                        <label class="form-check-label" for="exampleCheck1">Viento</label>
                     </div>
                
                  <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="total_captura_retenida">
                     <label class="form-check-label" for="exampleCheck1">Total captura retenida</label>
                  </div>
             </div>
              <div class="col">

              <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="dispositivo_selectividad">
                        <label class="form-check-label" for="exampleCheck1">Dispositivo de selectividad</label>
                     </div>
                
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="coordenadas">
                       <label class="form-check-label" for="exampleCheck1">Coordenadas</label>
                    </div>
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="retenida">
                       <label class="form-check-label" for="exampleCheck1">Captura retenida - (Nombre común + nombre científico + kg + cajones)</label>
                    </div>
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="incidental">
                       <label class="form-check-label" for="exampleCheck1">Captura incidental - (Nombre común + nombre científico + unidades)</label>
                    </div>
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="descartada">
                       <label class="form-check-label" for="exampleCheck1">Captura descartada - (Nombre común + nombre científico + kg + cajones)</label>
                    </div>
              </div>
           
          </div>  
          </div>
          <button type="button" wire:click="exportar()" class="btn btn-primary">Exportar Excel</button>
        </form>
     </div>


   </div>

   </div>

@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@stop

@section('plugins.Sweetalert2', true)

@section('js')

@livewireScripts
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
@stop

