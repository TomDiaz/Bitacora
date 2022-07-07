
@extends('adminlte::page')


@section('content_header')
<script src="https://kit.fontawesome.com/db792297f6.js" crossorigin="anonymous"></script>
@stop

@section('content')
 <br>
 <meta name="csrf-token" content="{{ csrf_token() }}">
 @method('DELETE')
<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col" style="text-align: center">#</th>
      <th scope="col" style="text-align: center">Año</th>
      <th scope="col" style="text-align: center">Marea</th>
      <th scope="col" style="text-align: center">Nº de viaje</th>
      <th scope="col" style="text-align: center">Embarcacion</th>
      <th scope="col" style="text-align: center">Bitácora</th>
      <th scope="col" style="text-align: center">Fecha de Ingreso</th>
      <th scope="col" style="text-align: center">Fecha de Salida</th>
      <th scope="col" style="text-align: center">Capitán</th>
      <th scope="col" style="text-align: right">PDF</th>
      <th scope="col"></th>
      <th scope="col"></th>
  
    </tr>
  </thead>
  <tbody>

    <?php
      $cont = 1;
    ?>

    @foreach($bitacoras as $bitacora)
       <tr>
         <th scope="row">{{ $cont++ }}</th>
         <td style="text-align: center">{{ date("Y", strtotime($bitacora['fecha_final']))}}</td>
         <td style="text-align: center">{{ $bitacora['marea']}}</td>
         <td style="text-align: center">{{ $bitacora['viaje_anual']}}</td>
         <td style="text-align: center">{{ $bitacora['embarcacion']}}</td>
         <td style="text-align: center">{{ $bitacora['nombre'] }} </td>
         <td style="text-align: center">{{$bitacora['fecha_inicial'] }} </td>
         <td style="text-align: center">{{$bitacora['fecha_final'] }} </td>
         <td style="text-align: center">{{$bitacora['capitan'] }} </td>
         <td style="text-align: center"><button type="button" style="width:100%;" onclick="getiframe('{{ env('APP_URL') . 'pdf/parte_de_pesca/' . $bitacora['id'] }}')" class="btn btn-danger"> PESCA  <i style="margin-left: 5px;"class="fa fa-file-pdf"></i></button></td>
         <td><button type="button" style="width:100%;" onclick="getiframe('{{ env('APP_URL') . 'pdf/general/' . $bitacora['id'] }}')" class="btn btn-danger"> GENERAL  <i style="margin-left: 5px;"class="fa fa-file-pdf"></i></button></td>
         <td><button onClick="deleteBitacora({{$bitacora['id']}})" style="display:block; width:100%;" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
         
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

@section('plugins.Sweetalert2', true)


@section('js')
 <script src="/js/controllers.js"></script>
@stop