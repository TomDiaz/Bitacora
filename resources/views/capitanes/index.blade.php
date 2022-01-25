
@extends('adminlte::page')


@section('content_header')
    <h1>Capitanes</h1>
@stop

@section('content')

 <a class="btn btn-secondary" href="{{ route('capitanes.create')}}">Nuevo capitan  <i class="fas fa-plus"></i></a>
 <hr>

<table class="table table-striped">
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

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop