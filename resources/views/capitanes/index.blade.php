
@extends('adminlte::page')


@section('content_header')
<script src="https://kit.fontawesome.com/db792297f6.js" crossorigin="anonymous"></script>
@stop


@section('content')
 <br>
 <a class="btn btn-dark animate__animated animate__lightSpeedInLeft " href="{{ route('capitanes.create')}}">Nuevo capitan  <i class="fas fa-plus"></i></a>
 <hr>

 <meta name="csrf-token" content="{{ csrf_token() }}">

<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Capitán</th>
      <th scope="col">Usuario</th>
      <th scope="col">E-mail</th>
      <th scope="col">Cuil</th>
      <th scope="col">Embarcaciones</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

    <?php
      $cont = 1;
    ?>

    @foreach($capitanes as $capitan)

       <tr>
         <th scope="row">{{ $cont++ }}</th>
         <td>{{ $capitan['capitan'] -> nombres }}  {{ $capitan['capitan'] -> apellidos }}</td>
         <td>{{ $capitan['capitan'] -> usuario}} </td>
         <td>{{ $capitan['capitan'] -> email}} </td>
         <td>{{ $capitan['capitan'] -> cuil}} </td>

         <td class="embarcaciones">
         @foreach($capitan['embarcaciones']  as $embarcacion)
            {{$embarcacion[0] -> Nombre}} -
         @endforeach
         </td>

         <td>
           <div class="row">
              <div class="mb-3 col" >
                 <a  href="{{ route('capitanes.edit',$capitan['capitan'] -> id )}}" style="display:block; width:50%; margin-left: 100px;"  class="btn btn-primary "><i class="fa-solid fa-pen"></i></a>
              </div>
              <div class="mb-3 col" >
                 <button onClick="deleteCapitan({{$capitan['capitan'] -> id}})" style="display:block; width:50%;" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
              </div>
           </div>
            <!-- <form action="{{route('capitanes.destroy', $capitan['capitan'] -> id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="display:block; width:100%;" class="btn btn-danger " type="submit">Eliminar</button>
            </form> -->

           
        </td>
       </tr>

    @endforeach
   
  </tbody>
</table>

<div class="paginacion">
     {{ $capitanes_bd -> links()}}
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