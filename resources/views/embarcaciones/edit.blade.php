@extends('adminlte::page')


@section('content')
<br>
<form class="formulario" action="{{route('embarcaciones.update', $embarcacion -> IdEmbarcacion)}}" method="POST">

    @csrf
    @method('PUT')

  <div class="datos contenido">

    <h3>DATOS DE LA EMBARCACION</h3>

    <div class="mb-3 ">
         <input type="text" class="form-control" name="embarcacion" value="{{$embarcacion -> Nombre}}" placeholder="Nombre de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>
     
       <div class="mb-3 ">
         <input type="text" class="form-control" name="matricula" value="{{$embarcacion -> Matricula}}"  placeholder="Matrícula de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>

    <div class="row">

    <div class="mb-3 col">
    <input type="text" class="form-control" name="permiso" value="{{$embarcacion -> PermisoPesca}}"  placeholder="Permiso de Pesca de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>

  <div class="mb-3 col">
    <input id="date" name="fecha_caducidad" value="{{$embarcacion -> FechaVigenciaPermisoPesca}}" required type="date">
  </div>
     
    </div>


  <div class="mb-3">

    <select class="form-control" name="pais" id="" required>
        <option value="Argentina">Argentina</option>
        <option value="España">España</option>
    </select>
  </div>

  <div class="mb-3">

    <select class="form-control" name="capitanes[]"  multiple >

      @foreach($capitanes as $capitan)
        <option value="{{$capitan -> id}}">{{$capitan -> nombres}} {{$capitan -> apellidos}}</option>
      @endforeach 
    </select>
  </div>
 

  
  <div class="butons">

       <button type="submit" style="display:block; width:100%; margin-bottom:5px;" class="btn btn-outline-primary">Guardar</button>
       <a  class="btn btn-outline-danger" style="display:block; width:100%;"  href="{{route('embarcaciones.index')}}">Cancelar</a> 

   </div>



  </div>


</form>


<style>
    .formulario .contenido{
  box-shadow: 1px 2px 10px 3px rgba(0, 0, 0, 0.1);
  padding: 50px;
  border-radius: 10px;
  margin-bottom: 20px
}

.formulario h3{
  color: #343a40;
  text-align: center;
  font-weight: 600;
}

.formulario input, .formulario select{
  width: 100%;
  height: 50px
}
</style>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop