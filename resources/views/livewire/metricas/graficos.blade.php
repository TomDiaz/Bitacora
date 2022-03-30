
<div>

@extends('adminlte::page')


@section('content_header')
@stop

@section('content')

<div class="container-fluid metricas">


  <div class="row">

    <div class="col-12">
        <div class="card mb-3 metrica-contenido">

            <div class="filtro-grafico">

            @if(!$grafico)       

            

                <form>
                    <div class="container" style="margin-top: 80px">

                       <div class="header">
                           <h2>Filtro de resultados</h2>
                           <hr>
                           <br>
                       </div>

                      <div class="row">
                        <div class="col">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Tipo de dato</label>
                              <select class="form-control"  id="tipo1" wire:model="tipo1">

                                  <option selected  value="">Elejir tipo de dato</option>

                                  @foreach($datos as $data)

                                    <option value="{{$data['id']}}">{{$data['nombre']}}</option>

                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Valor de busqueda</label> 
                              <input type="text" class="form-control" name="dato1" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="dato1">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                            <div class="mb-3">
                              <select class="form-control" name="tipo2" id="" wire:model="tipo2">
                                  
                                 <option selected  value="">Elejir tipo de dato</option>

                                  @foreach($datos as $data)

                                    <option value="{{$data['id']}}">{{$data['nombre']}}</option>

                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                              <input type="text" class="form-control" name="dato2" id="exampleInputEmail1" aria-describedby="emailHelp" wire:model="dato2">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label" >Desde</label>
                              <input class="form-control" type="date"  id="desde" wire:model="desde">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Hasta</label>
                              <input class="form-control" type="date"  id="hasta" wire:model="hasta">
                            </div>
                        </div>
                      </div>

                      <div class="row">

                         <div class="col">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Grafico</label>
                              <select class="form-control"  id="tipo_grafico" wire:model="tipo_grafico">
                                 <option value="doughnut">Elegir un tipo de grafico</option>
                                 <option value="doughnut">Grafico en Torta</option>
                                 <option value="line">Grafico en Linea</option>
                                 <option value="bar">Grafico en Barra</option>
                              </select>
                            </div>
                        </div>

                      </div>

                      <div class="col-12">
                            <button wire:click="mostar()" style="width:100%; display:block;" type="button" class="btn btn-primary" > Filtrar</button>
                        </div>
                    </div>
                </form>
                
                @endif


                @if($grafico)

                <div class="container resultados">

                  <div class="col-12">
                      <div class="card mb-3 metrica-header">
                          <h2>Resultados</h2>
                          <div>
                            <button type="button" id="btn-filtro" class="btn btn-dark"><i class="fas fa-file-excel"></i> <span>Reporte</span>  </button>
                            <button wire:click="ocultar()" type="button" id="btn-filtro" class="btn btn-dark"><i class="fas fa-search"></i> <span>Filtro</span>  </button>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col">
                           <div class="grafico {{$tipo_grafico}}" valor="{{$tipo_grafico}}">
                              <canvas id="myChart" ></canvas> 
                            </div>
                    </div>
                    <div class="col-4">
                    <div class="card mb-3 border-1" style="max-width: 540px;">
                          <div class="row g-0">
                            <div class="col-md-12">
                                <h5 class="card-title">Retenida</h5>
                                <span class="retenida" valor="{{$retenidas}}">{{ $retenidas }} KG</span>
                            </div>
                          </div>
                      </div>
                      <div class="card mb-3 border-2" style="max-width: 540px;">
                          <div class="row g-0">
                            <div class="col-md-12">
                                <h5 class="card-title">Incidental</h5>
                                 <span class="incidental" valor="{{ $incidentales }}">{{ $incidentales }} KG</span>
                            </div>
                          </div>
                      </div>
                      <div class="card mb-3 border-3" style="max-width: 540px;">
                          <div class="row g-0">
                            <div class="col-md-12">
                                <h5 class="card-title">Descarte</h5>
                                 <span class="descarte" valor="{{ $descarte }}">{{ $descarte }} KG</span>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endif

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

@section('plugins.Sweetalert2', true)

@section('js')

@livewireScripts
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>
   document.addEventListener('contentChanged', function () {
    let retenida = $(".retenida").attr("valor")
    let incidental = $(".incidental").attr("valor")
    let descarte = $(".descarte").attr("valor")
    let grafico = $(".grafico").attr("valor")

const data = {
  labels: ['Retenidas', 'Incidentales', 'Descarte'],
  datasets: [{
    label: 'Especies Retenidas',
    backgroundColor: ['rgb( 171, 235, 198)','rgb( 250, 215, 160 )','rgb( 241, 148, 138 )'],
    data: [retenida,incidental,descarte],
  }]
};

const config = {
  type: grafico,
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Cantidad de KG'
      }
    }
  },

};

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
    })

</script>

@stop

