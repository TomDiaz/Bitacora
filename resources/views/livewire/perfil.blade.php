
@extends('adminlte::page')


@section('content_header')
@stop

@section('content')

   <div class="card perfil metrica-contenido">

         <div class="card">
            <h5 class="card-header">Mis Datos</h5>
            <div class="card-body">
              <ul>
                  <li><b>Nombres:</b> {{$v_nombre}}</li>
                  <li><b>Apellidos:</b> {{$v_apellido}}</li>
                  <li><b>Email:</b> {{$v_email}}</li>
              </ul>

            </div>
          </div>
    

       <br>
   <form>
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Nombres</label>
         <input type="text" class="form-control" id="exampleInputEmail1" " wire:model="nombre">
       </div>
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Apellidos</label>
         <input type="text" class="form-control" id="exampleInputEmail1" " wire:model="apellido">
       </div>
       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Email</label>
         <input type="text" class="form-control" id="exampleInputEmail1" " wire:model="email">
       </div>
       
       <button wire:click="modificar()" type="submit" class="btn btn-primary">Modificar</button>

     </form>
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