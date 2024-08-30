
@extends('adminlte::page')


@section('content_header')
<script src="https://kit.fontawesome.com/0186074ad2.js" crossorigin="anonymous"></script>
@stop

@section('content')
<br>
<a class="btn btn-dark animate__animated animate__lightSpeedInLeft" href="{{ route('embarcaciones.create')}}">Nueva Embarcación  <i class="fas fa-plus"></i></a>
<hr>

<meta name="csrf-token" content="{{ csrf_token() }}">

<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Embarcación</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Permiso de Pesca</th>
      <th scope="col">Fecha de Caducidad</th>
      <th scope="col">Tipo de Barco</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

    <?php
      $cont = 1;
    ?>
  @foreach($embarcaciones as $embarcacion)
     <tr>
        <th scope="row">{{ $cont++ }}</th>
        <td>{{$embarcacion -> Nombre}}</td>
        <td>{{$embarcacion -> Matricula}}</td>
        <td>{{$embarcacion -> PermisoPesca}}</td>
        <td>{{$embarcacion -> FechaVigenciaPermisoPesca}}</td>
        <td>{{ $tipo_barcos[$embarcacion -> id_tipo_barco - 1] -> nombre }}</td>
        
         <td>
            <div class="btn-capitan">
              <a href="{{ route('embarcaciones.edit',$embarcacion -> IdEmbarcacion )}}"  class="btn btn-primary "><i class="fa-solid fa-pen"></i></a>
              <button onClick="deleteEmbarcacion({{$embarcacion -> IdEmbarcacion}})"  class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
           </div>
        </td>
      </tr>
   @endforeach

   
  </tbody>
</table>

<div class="paginacion">
     {{ $embarcaciones -> links()}}
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@stop

@section('plugins.Sweetalert2', true)

@section('js')
  <script src="/js/controllers.js"></script>
@stop