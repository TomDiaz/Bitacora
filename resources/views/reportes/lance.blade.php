
@extends('adminlte::page')


@section('content_header')
@stop

@section('content')
 <br>


<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Inico</th>
      <th scope="col">Fin</th>
      <th scope="col">Botacora</th>
      <th scope="col">Zona de Pesca</th>
      <th scope="col">Coordenadas Inicio</th>
      <th scope="col">Coordenadas Fin</th>
      <th scope="col">Arte de Pesca</th>
      <th scope="col">Especies Objetivo</th>
  
    </tr>
  </thead>
  <tbody>

    <?php
      $cont = 1;
    ?>

    @foreach($lances as $lance)
       <tr>
         <th scope="row">{{ $cont++ }}</th>
         <td>{{ $lance['fecha_inicial'] }} </td>
         <td>{{ $lance['fecha_final']}}</td>
         <td>{{ $lance['bitacora']}}</td>
         <td>{{ $lance['zona_de_pesca']}}</td>
         <td>{{$lance['coordenadas_inicio'] }} </td>
         <td>{{$lance['coordenadas_fin'] }} </td>
         <td>{{$lance['arte_pesca'] }} </td>
         <td>{{$lance['especies_objetivo'] }} </td>
       </tr>
    @endforeach
   
  </tbody>
</table>

<div class="paginacion">
     {{ $lances_bd -> links()}}
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