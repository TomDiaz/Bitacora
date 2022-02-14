
@extends('adminlte::page')


@section('content_header')
@stop

@section('content')
 <br>


<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Bitácora</th>
      <th scope="col">Embarcacion</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Capitán/es</th>
      <th scope="col">Fecha de Ingreso</th>
      <th scope="col">Fecha de Salida</th>
  
    </tr>
  </thead>
  <tbody>

    <?php
      $cont = 1;
    ?>

    @foreach($bitacoras as $bitacora)
       <tr>
         <th scope="row">{{ $cont++ }}</th>
         <td>{{ $bitacora['nombre'] }} </td>
         <td>{{ $bitacora['embarcacion']}}</td>
         <td>{{ $bitacora['matricula']}}</td>
         <td>{{ $bitacora['capitan']}}</td>
         <td>{{$bitacora['fecha_inicial'] }} </td>
         <td>{{$bitacora['fecha_final'] }} </td>
       </tr>
    @endforeach
   
  </tbody>
</table>

<div class="paginacion">
     {{ $bitacoras_bd -> links()}}
</div>




@stop

@section('css')
   <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@stop


@section('js')
 <script src="/js/controllers.js"></script>
@stop