@extends('adminlte::page')


@section('content')
<br>
<form class="formulario" action="{{route('embarcaciones.store')}}" method="POST">

    @csrf

  <div class="datos contenido">

    <h3>DATOS DE LA EMBARCACION</h3>

    <div class="mb-3 ">
         <label for="exampleInputEmail1" class="form-label">Embarcación</label>
         <input type="text" class="form-control" name="embarcacion" placeholder="Nombre de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>
     
       <div class="mb-3 ">
         <label for="exampleInputEmail1" class="form-label">Matrícula</label>
         <input type="text" class="form-control" name="matricula" placeholder="Matrícula de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>

    <div class="row">

    <div class="mb-3 col">
    <label for="exampleInputEmail1" class="form-label">Permiso de Pesca</label>
    <input type="text" class="form-control" name="permiso" placeholder="Permiso de Pesca de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>

  <div class="mb-3 col">
    <label for="exampleInputEmail1" class="form-label">Fecha de Caducidad</label>
    <input id="date" name="fecha_caducidad" required type="date">
  </div>
     
    </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">PAIS ABANDERAMIENTO</label>

    <select class="form-control" name="pais" id="" required>
        <option value="Argentina">Argentina</option>
        <option value="España">España</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">CAPITANES ASIGNADOS</label>

    <select class="form-control" name="capitanes[]" required multiple >

      @foreach($capitanes as $capitan)
        <option value="{{$capitan -> IdCapitan}}">{{$capitan -> Nombres}} {{$capitan -> Apellidos}}</option>
      @endforeach 
    </select>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ARTE DE PESCA</label>

    <select class="form-control" name="arte_pesca"  multiple id="">

    @foreach($artepesca as $arte)
        <option value="{{$arte -> IdArtePesca}}">{{$arte -> Nombre}}</option>
      @endforeach 

      </select>
  </div>

  <button type="submit" style="display:block; width:100%;" class="btn btn-primary">Guardar</button>

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