<div>

@extends('adminlte::page')


@section('content_header')
<script src="https://kit.fontawesome.com/60e25ae04f.js" crossorigin="anonymous"></script>
@stop

@section('content')


  <div class="container-fluid metricas">

     <div class="metrica-contenido card" style="padding:20px">
        <form id="form-exel" valido="{{$valido}}">
            <div class="form-group  datos-aincluir" >
                <h4>Datos a incluir en planilla</h4>
                <br>
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
                        <input type="checkbox" class="form-check-input" wire:model="cuil">
                        <label class="form-check-label" for="exampleCheck1">Capitán - Cuil</label>
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
                           <input type="checkbox" class="form-check-input" wire:model="marea">
                           <label class="form-check-label" for="exampleCheck1">Marea</label>
                        </div>
                        
                    <div class="form-group form-check">
                           <input type="checkbox" class="form-check-input" wire:model="anio">
                           <label class="form-check-label" for="exampleCheck1">Año</label>
                        </div>

                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="observaciones_generales">
                        <label class="form-check-label" for="exampleCheck1">Observaciones generales</label>
                     </div>

                     <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="observaciones_parte_de_pesca">
                        <label class="form-check-label" for="exampleCheck1">Observacion parte de pesca</label>
                     </div>

                     <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="millas_recorridas">
                     <label class="form-check-label" for="exampleCheck1">Millas recorridas</label>
                  </div>
                

                
                   
              </div>
              <div class="col">

              <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="produccion_total">
                     <label class="form-check-label" for="exampleCheck1">Producción total</label>
                  </div>

              <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="combustible">
                     <label class="form-check-label" for="exampleCheck1">Combustible</label>
                  </div>
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
                
                
             </div>
              <div class="col">

              <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" wire:model="total_captura_retenida">
                     <label class="form-check-label" for="exampleCheck1">Total captura retenida</label>
                  </div>

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
                       <label class="form-check-label" for="exampleCheck1">Captura retenida </label>
                    </div>
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="incidental">
                       <label class="form-check-label" for="exampleCheck1">Captura incidental </label>
                    </div>
                    <div class="form-group form-check">
                       <input type="checkbox" class="form-check-input" wire:model="descartada">
                       <label class="form-check-label" for="exampleCheck1">Captura descartada </label>
                    </div>
              </div>
           
          </div>  
          </div>
          <hr>
          <br>
        
          <h4>Fecha de inicio de bitácora</h4>

          <div class="row">
                
                <div class="col-3">
                  <label for="exampleInputEmail1">Desde</label>
                  <input class="form-control" type="date" name="" id="" wire:model="desde">
                </div>
                <div class="col-3">
                   <label for="exampleInputEmail1">Hasta</label>
                   <input class="form-control" type="date" name="" id="" wire:model="hasta">
                </div>
          </div>
          <br>
          <hr>
         

          @if (session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
         @endif

           <div class="botones-exel">


              <button type="button" wire:click="all()" class="btn btn btn-dark">Seleccionar todos</button>
              <button type="button" wire:click="none()" class="btn btn btn-dark"> Eliminar selección</button>
              <button type="button" wire:click="exportar()" class="btn btn-success">Exportar Excel</button>
           </div> 
        </form>
     </div>


   </div>

   
      

   </div>

@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
@stop


@section('js')

@livewireScripts
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
@stop

