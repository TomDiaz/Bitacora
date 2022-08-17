
@extends('adminlte::page')


@section('content_header')
@stop

@section('content')
 <br>


<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Inicio</th>
      <th scope="col">Fin</th>
      <th scope="col">Bitácora</th>
      <th scope="col">Zona de Pesca</th>
      <th scope="col">Coordenadas Inicio</th>
      <th scope="col">Coordenadas Fin</th>
      <th scope="col">Especies Objetivo</th>
      <th scope="col"></th>
  
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
         <td>{{$lance['coordenadas_inicio']['latitud']. ', ' . $lance['coordenadas_inicio']['longitud']}} </td>
         <td>{{$lance['coordenadas_fin']['latitud']. ', ' . $lance['coordenadas_fin']['longitud']}} </td>
         <td>{{$lance['especies_objetivo'] }} </td>
         <td style="text-align: center"><button type="button" style="width:100%;" onclick="getMap({{ json_encode($lance['coordenadas_inicio']) }}, {{ json_encode($lance['coordenadas_fin']) }})" class="btn btn-success""> Ver mapa  <i style="margin-left: 5px;" class="fas fa-map-marked-alt"></i></button></td>
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

@section('plugins.Sweetalert2', true)

@section('js')

    <script src="/js/controllers.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlni9hQYjZNGRajKPoGaoJdlhCr6Xpt8I&callback=initMap"></script>
@stop