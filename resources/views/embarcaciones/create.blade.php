@extends('adminlte::page')


@section('content')
<br>
<form class="formulario" action="{{route('embarcaciones.store')}}" method="POST">

    @csrf

  <div class="datos contenido animate__animated animate__lightSpeedInLeft">

    <h3 style="text-align:center;">DATOS DE LA EMBARCACION</h3>

    <div class="mb-3 ">
         
         <input type="text" class="form-control" name="embarcacion" placeholder="Nombre de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>
     
       <div class="mb-3 ">
         
         <input type="text" class="form-control" name="matricula" placeholder="Matrícula de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
       </div>

    <div class="row">

    <div class="mb-3 col">
    
    <input type="text" class="form-control" name="permiso" placeholder="Permiso de Pesca de la embarcación" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>

  <div class="mb-3 col">
    
    <input id="date" name="fecha_caducidad" required type="date">
  </div>
     
    </div>


  <div class="mb-3">
    

    <select class="form-control" name="capitanes[]" required multiple >

      @foreach($capitanes as $capitan)
        <option value="{{$capitan -> id}}">{{$capitan -> nombres}} {{$capitan -> apellidos}}</option>
      @endforeach 
    </select>
  </div>

  <div class="butons">

       <button type="submit" style="display:block; width:100%; margin-bottom: 5px" class="btn btn-outline-primary">Guardar</button>
      
       <a  class="btn btn-outline-danger" style="display:block; width:100%;"  href="{{route('embarcaciones.index')}}">Cancelar</a> 

   </div>

  
  </div>


</form>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop