@extends('adminlte::page')


@section('content')
<br>
<form  class="formulario" action="{{route('capitanes.update', $capitan -> id)}}" method="POST">

    @csrf
    @method('PUT')
    
    
    <div class="row contenido justify-content-around animate__animated animate__lightSpeedInLeft">

    
          <div class="col-12">

            <div class="datos ">
          
              <h3>DATOS DEL CAPITÁN</h3>
              <hr>
          
            <div class="mb-3">
              <input type="text" class="form-control active" name="nombre" placeholder="Nombres" value="{{$capitan ->nombres}}"  id="nombre" aria-describedby="emailHelp" >
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="text" class="form-control active" name="apellido"  placeholder="Apellidos" value="{{$capitan -> apellidos}}"  id="apellido" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
          
            <div class="mb-3">
              <input type="number" class="form-control active" name="cuil" placeholder="Cuil"  id="cuil" value="{{$capitan -> cuil}}" aria-describedby="emailHelp" >
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="email" class="form-control active" name="email" placeholder="Email"  id="email" value="{{$capitan -> email}}" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="number" class="form-control active" name="celular" placeholder="Celular"  id="celular" value="{{$capitan ->celular}}" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
            </div>

          </div>


          <div class="col-12">
     
          
             <div class="butons">

               <button type="submit" class="btn btn-outline-primary">Guardar</button>
               <a  class="btn btn-outline-danger" href="{{route('capitanes.index')}}">Cancelar</a> 

             </div>
             
          
          </div>
            
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