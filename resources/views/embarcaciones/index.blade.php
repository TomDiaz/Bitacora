
@extends('adminlte::page')


@section('content_header')
    <h1>Embarcaciones</h1>
@stop

@section('content')

<a class="btn btn-secondary" href="{{ route('embarcaciones.create')}}">Nueva embarcacion  <i class="fas fa-plus"></i></a>
<hr>

<table class="table table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Embarcación</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Permiso de Pesca</th>
      <th scope="col">Fecha de Caducidad</th>
      <th scope="col"> Días sin Bitacora</th>
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
        <td>0</td>
        
        <td ><a href="{{ route('embarcaciones.edit',$embarcacion -> IdEmbarcacion )}}" style="display:block; width:100%;" class="btn btn-primary ">Editar</a></td>
         <td>
            <form action="{{route('embarcaciones.destroy',$embarcacion -> IdEmbarcacion)}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="display:block; width:100%;" class="btn btn-danger " type="submit">Eliminar</button>
            </form>
        </td>
      </tr>
   @endforeach
   
  </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop