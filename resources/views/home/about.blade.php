@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
   <br>
   <div class="dashboard">

   <div class="row ">



  <div class="col-12">
    <div class="card about animate__animated animate__bounceInUp">

      <div class="row">

      <div class="col">
          <div class="card-body">
            <h3>Bitácora Electrónica de Pesca</h3>
            <p class="card-text">La Bitácora Electrónica de Pesca (BEP) es un sistema gratuito y de código abierto que permite a los capitanes y/o pescadores utilizar sus dispositivos móviles para registrar y transmitir electrónicamente datos de las capturas y el esfuerzo pesquero, y facilita a los armadores y quienes tengan acceso, a realizar un seguimiento eficaz de la pesca a través de un sitio web. Componentes del sistema BEP 
            <br><br>
            1. Aplicación Móvil. - Permite a los capitanes registrar digitalmente, en tiempo real, la fecha y hora, la posición geográfica, la duración y la información sobre las capturas de cada lance. Cada bitácora agrupa la información total de los lances hechos en un viaje. Las funciones de registro de datos de la aplicación pueden operar sin Internet ni señal de teléfono móvil. Cuando se conecta a Internet, la aplicación envía automáticamente la información registrada por los usuarios a una base de datos segura en línea. De este modo, la aplicación enlaza directamente la información generada en el mar con el Sitio Web.  
            <br><br>
Los capitanes pueden ingresar a su usuario una vez que fue dado de alta por su armador anteriormente mediante el sitio web. El usuario y contraseña le llega al capitán mediante correo electrónico. 
<br><br>
Para el correcto funcionamiento de la aplicación, se requiere que el dispositivo donde se instale tenga Android 7.0, 2GB mínimo de almacenamiento, GPS y Wifi. 
<br><br>
2. Sitio Web. - De uso para los armadores para lo cual se requiere de registro. Una vez con acceso, pueden registrar sus embarcaciones y capitanes, y consultar los reportes generados por parte de los capitanes mediante la aplicación móvil, a los que les da el alta. Además, la web puede ser de uso por parte de las autoridades para consultas de reportes, armadores, embarcaciones y capitanes, lo cual se dará bajo los términos y condiciones previamente acordados. Ninguna información será compartida con personas distintas a armadores y capitanes sin previo consentimiento. 
          
          </p>
            <a target="_blank" href="https://bepa.com.ar/manual.pdf" hr class="btn btn-dark">Manual de uso <i style="margin-left:10px" class="fa fa-info-circle"></i></a>
          </div>
        </div>

        <div class="col-3 img">

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
           <div class="carousel-inner">
             <div class="carousel-item active">
               <img src="img/home1.jpg" class="d-block w-100" alt="...">
             </div>
             <div class="carousel-item">
               <img src="img/home2.jpg" class="d-block w-100" alt="...">
             </div>
           </div>
         </div>

        </div>

        

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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@stop