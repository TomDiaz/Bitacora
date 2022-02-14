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
      <div class="card-body">
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
  </div>
  <div class="col">
  <div class="card mb-3 animate__animated animate__lightSpeedInLeft" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4 icono">
      <div class="icono "><i class="fas fa-users"></i></div>
      <span class="color_2"> {{ $capitanes }} </span>
    </div>
    <div class="col-md-8">
      <div class="card-body">
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

  <div class="col">
     <div class="card mb-3 animate__animated animate__lightSpeedInLeft" style="max-width: 540px;">
   
         
       
     </div>
  </div>

  <div class="col-12">
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>


const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'EMBARCACIONES',
      backgroundColor: 'r#1f97d7',
      borderColor: 'r#1f97d7',
      data: [0, 16, 5, 2, 20, 30, 45],
    },
    {
      label: 'CAPITANES',
      backgroundColor: '#0a8290',
      borderColor: '#0a8290',
      data: [0, 4, 15, 20, 0,  7, 4],
    }
  ]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );



</script>

  
@stop