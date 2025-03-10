@extends('adminlte::page')

@section('content_header')
<script src="https://kit.fontawesome.com/0186074ad2.js" crossorigin="anonymous"></script>
@stop

@section('content')
<br>
<form class="formulario" action="{{route('embarcaciones.update', $embarcacion -> IdEmbarcacion)}}" method="POST">

    @csrf
    @method('PUT')

  <div class="datos contenido">

    <h3>EDICIÓN - DATOS DE LA EMBARCACION </h3>

    <div class="mb-3 ">
         <input type="text" class="form-control" name="embarcacion" value="{{$embarcacion -> Nombre}}" placeholder="Nombre de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" >
       </div>
     

    <div class="row">

    <div class="mb-3 col">
         <select class="form-control" name="barco"  id="" aria-describedby="emailHelp">
                <option value="" > Tipo de embarcacion</option>
                @foreach($tipo_barcos as $barco)
                   <option value="{{$barco->id}}" {{ $embarcacion->id_tipo_barco == $barco->id ? 'selected' : '' }}>{{$barco->nombre}}</option>
                @endforeach
         </select>
       </div>
     
      <div class="mb-3 col">
        <input type="text" class="form-control" name="matricula" value="{{$embarcacion -> Matricula}}"  placeholder="Matrícula de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" >
      </div>
    </div>


    <div class="row">

    <div class="mb-3 col">
    <input type="text" class="form-control" name="permiso" value="{{$embarcacion -> PermisoPesca}}"  placeholder="Permiso de Pesca de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>

  <div class="mb-3 col fecha">
    <label for="">Fecha caducidad</label>
    <input id="date" class="form-control" name="fecha_caducidad" value="{{$embarcacion -> FechaVigenciaPermisoPesca}}" required type="date">
  </div>
     
    </div>


  <div class="row">
      <div class="mb-3" style="margin-left: 10px;">
         <button type="button" onclick="popupCapitanes({{json_encode($capitanes)}})"  class="btn btn-dark btn-list-capitanes">Agregar Capitan/es <span>{{ count($capitanes_array) }}</span></button>
      </div>
    </div>

    <hr>
 

  
  <div class="butons">

       <button type="submit" style="display:block; width:100%; margin-bottom:5px;" class="btn btn-outline-primary">Guardar</button>
       <a  class="btn btn-outline-danger" style="display:block; width:100%;"  href="{{route('embarcaciones.index')}}">Cancelar</a> 

   </div>



  </div>


</form>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('plugins.Sweetalert2', true)



@section('js')
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>  
  <script src="/js/controllers.js"></script>
  <script src="/js/errors.js"></script>
  <script src="https://kit.fontawesome.com/874ba803fc.js" crossorigin="anonymous"></script>
  
@if ($errors->any())
   <script>
     alertError(<?php echo json_encode($errors->all()) ?>)
   </script>
@endif
@stop