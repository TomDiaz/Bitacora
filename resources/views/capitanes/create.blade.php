@extends('adminlte::page')


@section('content')
<br>
<form id="form_cap" class="formulario">

    @csrf

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    
    <div class="row contenido justify-content-around animate__animated animate__lightSpeedInLeft">


          <div class="col-6">

            <div class="datos ">
          
              <h3>DATOS DEL CAPITÁN</h3>
              <hr>
          
            <div class="mb-3">
              <input type="text" class="form-control active" name="nombre" placeholder="Nombres"  id="nombre" aria-describedby="emailHelp" >
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="text" class="form-control active" name="apellido"  placeholder="Apellidos"  id="apellido" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
          
            <div class="mb-3">
              <input type="number" class="form-control active" name="cuil" placeholder="Cuil"  id="cuil" aria-describedby="emailHelp" >
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="email" class="form-control active" name="email" placeholder="Email"  id="email" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
            <div class="mb-3">
              <input type="number" class="form-control active" name="celular" placeholder="Celular"  id="celular" aria-describedby="emailHelp">
              <div class="icono"></div>
            </div>
          
            </div>

          </div>


          <div class="col-4">

            <div class="app ">
          
              
              <div class="inputs">
               <h3>USUARIO APP</h3>

               <div class="mb-3">
                 <input type="text" class="form-control active" name="usuario" placeholder="Usuario"  id="usuario" aria-describedby="emailHelp">
                 <div class="icono"></div>
               </div>
               
               <div class="mb-3">
                 <input type="password" class="form-control active" name="clave" placeholder="Clave"  id="clave" aria-describedby="emailHelp">
                 <div class="icono"></div>
               </div>
               
               
               <div class="mb-3">
                 <input type="password" class="form-control active" name="clave_confirmation" placeholder="Confirmar clave"  id="clave_confirmation" aria-describedby="emailHelp">
                 <div class="icono"></div>
               </div>
             </div>
          
             <div class="butons">

               <button type="submit" class="btn btn-outline-primary">Guardar</button>
               <a  class="btn btn-outline-danger" href="{{route('capitanes.index')}}">Cancelar</a> 

             </div>
             
          
          </div>
            
          </div>

    </div>

</form>



@stop

@section('css')
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@stop

@section('plugins.Sweetalert2', true)

@section('js')
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>  
  <script src="/js/controllers.js"></script>
  <script src="https://kit.fontawesome.com/874ba803fc.js" crossorigin="anonymous"></script>
@stop