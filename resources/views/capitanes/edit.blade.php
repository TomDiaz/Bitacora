@extends('adminlte::page')


@section('content')
<br>
<form class="formulario" action="{{ route('capitanes.update',$capitan -> IdCapitan) }}" method="POST">

    @csrf
    @method('PUT')

  <div class="datos contenido">

    <h3>DATOS DEL CAPITÁN</h3>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombres</label>
    <input type="text" class="form-control" name="nombre" value="{{$capitan -> Nombres}}" placeholder="Nombres completos" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Apellidos</label>
    <input type="text" class="form-control" name="apellido" value="{{$capitan -> Apellidos}}" placeholder="Apellidos completos" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tipo de identificación</label>

    <select class="form-control" name="tipo_identificacion" id="">
        <option value="cedula">Cedula</option>
        <option value="RUC">RUC</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Número de Identificación</label>
    <input type="text" class="form-control" value="{{$capitan -> Identificacion}}" name="nro_identificacion" placeholder="Identificación del Capitán" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email del Capitán</label>
    <input type="email" class="form-control" value="{{$capitan -> Email}}"  name="email" placeholder="Email del Capitán" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Celular del Capitán</label>
    <input type="text" class="form-control" value="{{$capitan -> Celular}}"  name="celular" placeholder="Numero celular del Capitán" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  </div>


  <div class="app contenido">

   <h3>USUARIO APP</h3>

<div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Crear Usuario para el Capitán</label>
  <input type="text" class="form-control" name="usuario" value="{{$capitan -> Usuario}}" placeholder="Nombres completos" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>

<div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Clave</label>
  <input type="password" class="form-control" name="clave1" value="{{$capitan -> Clave}}" placeholder="Apellidos completos" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>


<div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Clave confirmación</label>
  <input type="password" class="form-control" name="clave2" value="{{$capitan -> Clave}}" placeholder="Identificación del Capitán" id="exampleInputEmail1" aria-describedby="emailHelp">
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