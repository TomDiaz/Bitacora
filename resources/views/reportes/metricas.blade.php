@extends('adminlte::page')


@section('content_header')
@stop

@section('content')

<div class="filtro">
    <form>

        <div class="row">
            <div class="col-8">
             <div class="mb-3">
                 <label for="exampleInputEmail1" class="form-label">Especie</label>
                 <input type="text" class="form-control" name="especie" placeholder="Nombre de la especie" id="exampleInputEmail1" aria-describedby="emailHelp">
             </div>
         
           </div>
           <div class="col">
              <div class="mb-3">
                 <label for="exampleInputEmail1" class="form-label">Fecha de captura</label>
                 <input id="date" name="fecha" class="form-control" type="date">
             </div>
           </div>
        </div>

        <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tipo de especie</label>
                <select  class="form-control" name="tipo" id="">
                    <option value="" disable>Todos</option>
                    <option value="1" disable>Retenida</option>
                    <option value="2" disable>Incidental</option>
                    <option value="3" disable>Descarte</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Capitan</label>
                <select  class="form-control" name="capitan" id="">
                    <option value="" disable>Todos</option>
                    @foreach($capitanes as $capitan)
                    <option value="{{$capitan -> id}}" disable>{{$capitan -> nombres . " " . $capitan -> apellidos}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Embarcacion</label>
                <select  class="form-control" name="embarcacion" id="">
                    <option value="" disable>Todos</option>
                    @foreach($embarcaciones as $embarcacion)
                    <option value="{{$embarcacion -> IdEmbarcacion}}" disable>{{$embarcacion -> Nombre}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Arte de pesca</label>
                <select  class="form-control" name="arte" id="">

                    <option value="" disable>Todos</option>
                    @foreach($arte_pesca as $arte)
                    <option value="{{$arte -> id}}" disable>{{$arte -> nombre}}</option>
                    @endforeach
                </select>
              </div>
            </div>
       
        </div>
        
        <hr>
        <button style="width: 120px" type="submit" class="btn btn-primary ">Filtrar</button>
        <button style="width: 120px" type="button" class="btn btn-danger btn-cancelar-filtro">Cancelar</button>
    </form>
</div>
   
<div class="container-fluid">


  <div class="row">

    <div class="col-12">
        <div class="card mb-3 metrica-header">
            <h2>Metricas</h2>
            <button type="button" id="btn-filtro" class="btn btn-dark"><i class="fas fa-search"></i>  <span>Filtro</span>  </button>
        </div>
    </div>
    <div class="col-8">
    
        <div class="card mb-3 metrica-contenido">

         @component('graficos.doughnut')
         @endcomponent
        
        </div>


    </div>
    <div class="col">
    <div class="card mb-3 metrica-contenido metrica-especies">

        <div class="especie-header">
           <div class="row">
             <div class="col-6">
               Nombre
             </div>
          
             <div class="col">
               Kilogramos
             </div>
             <div class="col">
               Cantidad
             </div>
           </div>
        </div>

        <hr>
        @foreach( $especies as $especie)
        <div class="especie border-{{$especie['tipo']}} ">
           <div class="row">
             <div class="col-6">
               {{  $especie['nombre']}}
             </div>
       
             <div class="col">
             {{  $especie['kilogramos']}} kg
             </div>
             <div class="col">
             {{  $especie['cantidad']}} U
             </div>
           </div>
        </div>

        @endforeach

    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="/js/main.js"></script>
@stop