
@extends('adminlte::page')


@section('content_header')
@stop

@section('content')
 <br>
 <a class="btn btn-secondary animate__animated animate__lightSpeedInLeft " href="{{ route('capitanes.create')}}">Nuevo capitan  <i class="fas fa-plus"></i></a>
 <hr>

<table class="table table-striped animate__animated animate__zoomIn">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Capitán</th>
      <th scope="col">Usuario</th>
      <th scope="col">Clave</th>
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
         <td>{{ $capitan['capitan'] -> Nombres }}  {{ $capitan['capitan'] -> Apellidos }}</td>
         <td>{{ $capitan['capitan'] -> Usuario}} </td>
         <td>{{ $capitan['capitan'] -> Clave}} </td>

         <td class="embarcaciones">
         @foreach($capitan['embarcaciones']  as $embarcacion)
            {{$embarcacion[0] -> Nombre}} -
         @endforeach
         </td>

         <td ><a href="{{ route('capitanes.edit',$capitan['capitan'] -> IdCapitan )}}" style="display:block; width:100%;" class="btn btn-primary ">Editar</a></td>
         <td>
            <form action="{{route('capitanes.destroy', $capitan['capitan'] -> IdCapitan)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="display:block; width:100%;" class="btn btn-danger " type="submit">Eliminar</button>
            </form>
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
    <script> console.log('Hi!'); </script>

    <script> 

     @if ( session('mensaje') )

      Swal.fire({
        position: 'center-center',
        icon: 'success',
        title: 'Capitan agregado con exito!!',
        showConfirmButton: false,
        timer: 2000,
        type: "success",
      })

      @endif

     </script>

@stop