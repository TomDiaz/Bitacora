@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
   <br>
   <div class="dashboard">

   <div class="row ">
  <div class="col">
  <div class="card mb-3 animate__animated animate__lightSpeedInLeft" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4 icono">
       <div class="icono"><i class="fas fa-ship"></i></div>
       <span> {{ $embarcaciones }}  </span>
    </div>
    <div class="col-md-8">
      <div class="card-body body-home">
        <h5 class="card-title">EMBARCACIONES</h5>
        <p class="card-text"><small class="text-muted">Embarcaciones registradas en el sitio web</small></p>

        <div class="botones">
            <a class="btn btn-outline-secondary" href="embarcaciones">Consultar</a>
            <a class="btn btn-outline-primary" href="{{ route('embarcaciones.create')}}">Agregar</a>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="card mb-3 animate__animated animate__lightSpeedInLeft" style="max-width: 540px;">
<div class="row g-0">
  <div class="col-md-4 icono">
    <div class="icono "><i class="fas fa-users"></i></div>
    <span class="color_2"> {{ $capitanes }} </span>
  </div>
  <div class="col-md-8">
    <div class="card-body body-home">
      <h5 class="card-title">CAPITANES</h5>
      <p class="card-text"><small class="text-muted">Capitanes registrados en el sitio web</small></p>

      <div class="botones">
          <a class="btn btn-outline-secondary" href="capitanes">Consultar</a>
          <a class="btn btn-outline-primary" href="{{ route('capitanes.create')}}">Agregar</a>
      </div>
    </div>
  </div>
</div>
</div> 
  </div>

 

  <div class="col-8 home-estadisticas">
     <div class="card mb-3 animate__animated animate__bounceInUp" >
   
          <div>
             <canvas id="myChart" ></canvas>
          </div>
       
     </div>
  </div>
 


</div>

   </div>

  

@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@stop

@section('plugins.Sweetalert2', true)

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="/js/graficos.js"></script>

 <?php  use App\Models\User; ?>
@if(auth()->user() -> terminos_condiciones != 1)

<script>

Swal.fire({
  icon: 'error',
  allowOutsideClick: false,
  title: 'Términos y Condiciones ',
  html: `<div class="conidicones">  <p>
   El Usuario debe leer, entender y aceptar todas las condiciones establecidas en estas Condiciones Generales y demás políticas y principios incorporados a las mismas por referencia, previo a su registro como Usuario y/o la utilización del Software BEP. Si por alguna razón no estuviera de acuerdo con alguno de los términos y condiciones del presente documento, el Usuario deberá abstenerse de proporcionar la información requerida a través de la aplicación móvil o la plataforma Web. 
  <br> <br>
  El usuario acepta utilizar el software BEP al que tuviera acceso, única y exclusivamente para el uso que la misma está dispuesta. 
  <br> <br>
  El usuario declara ser único y absoluto responsable por el contenido y/o la información y/o documentación ingresada en el software BEP, como así de su veracidad, integridad, exhaustividad, vigencia, autenticidad y/o legalidad.  
  <br> <br>
 Asimismo, el usuario declara ser único y absoluto responsable por el contenido y/o la información y/o documentación ingresada en el software BEP, como así de su veracidad, integridad, exhaustividad, vigencia, autenticidad y/o legalidad, reconociendo que la misma estará alojada en un servidor web.  
 <br>
 <br>
 
 El usuario asegura que posee y siempre poseerá autorizaciones necesarias para generar, ingresar, alojar, modificar información que se realice mediante el software BEP y que la misma cumple y siempre cumplirá con todas las exigencias legales exigidas por las autoridades competentes en Argentina. 
 <br>
 <br>
 
 El usuario acepta y reconoce que el Software BEP puede no siempre estar disponibles debido a dificultades técnicas o fallas de Internet, del proveedor, o por cualquier otro motivo. En consecuencia, los implementadores del Software BEP, no se responsabilizan por la interrupción, suspensión, finalización, falta de disponibilidad o de continuidad del funcionamiento de su sistema. 
    </p> </div>`,
    confirmButtonText: 'Acepto los terminos y codiciones <i class="fa fa-thumbs-up"></i>'
 
})
.then((result) => {
   if(result.value){
     <?php  
        $user = User::find(auth()->user() -> id);
        $user -> terminos_condiciones = 1;
        $user -> save();
     ?>
  }
})

</script>

@endif

  
@stop