<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

body { font-family: "Gill Sans Extrabold", Helvetica, sans-serif }

       table{
          width: 100%;
          font-size: 12px;
          border-collapse: collapse
        } 

        .table-1 th:nth-child(1) {
  width: 20%;

}

.table-2 th:nth-child(1),.table-2 th:nth-child(3) {
  width: 20%;
}

table th, table td{
  padding: 8px
}

table td{
    text-align: center;
}

.table-1 th, .table-2 th {
   border: solid 1px;
}

.table-3 th:nth-child(1){
  width: 20%
}

.table-3 th:nth-child(2){
  width: 30%
}

.titulo{
    background: #e6e6e6;
}
.sub-titulo{
    background: #F0F3F4;
}

.table-4 th{
  width: 50.4%;
}

.lance th:nth-child(1), .lance th:nth-child(3){
  width: 30%;
}



 img{
  width: 80px;
}


        
    </style>

</head>
<body>


   

     <table >
        <thead>
          <tr>
            <th style="text-align: center"> 
            <h1 style="margin-left: 130px">Bitacora Electrónica de Pesca </h1>
            <span style="margin-left: 130px">FECHA: {{ date("d/m/Y", strtotime($general['bitacora'] -> fecha_inicial))}}</span>
          </th>
            <th style="text-align: right"> <img src="vendor/adminlte/dist/img/logo.png" alt=""></th>
          </tr>
        </thead>
    </table>

    <br>

    <!-- BITACORA ------------------------------------------------------------------------->
    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>Información general</th>
          </tr>
        </thead>
    </table>
    <table class="table-1" border="1" >
        <thead>
          <tr>
            <th>Armador</th>
            <th><span> {{ $general['armador'] }} </span></th>
          </tr>
          <tr>
            <th>Embarcación</th>
            <th><span> {{ $general['embarcacion'] -> Nombre }} </span></th>
          </tr>
          <tr>
            <th>Matricula</th>
            <th><span> {{ $general['embarcacion'] -> Matricula }} </span></th>
          </tr>
          <tr>
            <th>Tipo de Barco</th>
            <th><span> {{ $general['barco']}} </span></th>
          </tr>
          <tr>
            <th>Permiso de Pesca</th>
            <th><span> {{ $general['embarcacion'] -> PermisoPesca }} </span></th>
          </tr>
          <tr>
            <th>Capitán</th>
            <th><span> {{ $general['capitan'] }} </span></th>
          </tr>
          <tr>
            <th>CUIT</th>
            <th><span> {{ $general['cuit'] }} </span></th>
          </tr>
          <tr>
            <th>N° de tripulantes</th>
            <th><span> {{ $general['bitacora'] -> tripulantes}} </span></th>
          </tr>
          <tr>
            <th>Año</th>
            <th><span> {{ date("Y", strtotime($general['bitacora'] -> fecha_inicial))}} </span></th>
          </tr>
          <tr>
            <th>Marea</th>
            <th><span> {{ $general['bitacora'] -> marea}} </span></th>
          </tr>
          <tr>
            <th>Viaje Anual N°</th>
            <th><span> {{ $general['bitacora'] -> viaje_anual}} </span></th>
          </tr>
        </thead>
    </table>

 
    <table class="table-3" border="1" >
        <thead>
          <tr>
            <th></th>
            <th class="titulo" style="width: 120px;">Fecha</th>
            <th class="titulo" style="width: 120px;">Hora</th>
            <th class="titulo">Puerto</th>
          </tr>
        </thead>
    </table>
    <table class="table-2" border="1" >
        <thead>
          <tr>
            <th>Zarpe</th>
            <th style="width: 120px;"><span> {{ date("d/m/Y", strtotime($general['bitacora'] -> fecha_inicial))}} </span></th>
            <th style="width: 120px;"><span> {{ date("H:i", strtotime($general['bitacora'] -> fecha_inicial))}} </span></th>
            <th><span> {{ $general['zarpe'] }} </span></th>
          </tr>
          <tr>
            <th>Desembarque</th>
            <th style="width: 120px;"><span> {{ date("d/m/Y", strtotime($general['bitacora'] -> fecha_final))}} </span></th>
            <th style="width: 120px;"><span> {{ date("H:i", strtotime($general['bitacora'] -> fecha_final))}} </span></th>
            <th><span> {{ $general['arribo'] }} </span></th>
          </tr>
        </thead>
    </table>

    <table class="table-1" border="1" >
        <thead>
          <tr>
            <th>Cantidad total de lances</th>
            <th><span> {{ $general['total_lances'] }} </span></th>
          </tr>
          <tr>
            <th>Arte de pesca</th>
            <th><span> {{ $general['arte_pesca_nombre'] }} </span></th>
          </tr>
          <tr>
            <th>Zona de pesca</th>
            <th><span> {{ $general['zona_pesca'] }} </span></th>
          </tr>
          <tr>
            <th>Subárea</th>
            <th><span> {{ $general['bitacora']  -> subarea}} </span></th>
          </tr>
          <tr>
            <th>Observador a bordo</th>
            <th><span> {{ $general['observador'] }} </span></th>
          </tr>
          <tr>
            <th>Prospección</th>
            <th><span> {{ $general['prospeccion'] }} </span></th>
          </tr>
          <tr>
            <th>Especie prospección</th>
            <th><span> {{ $general['especie_prospeccion'] }} </span></th>
          </tr>
        </thead>
    </table>
  
    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>Dispositivo de selectividad</th>
          </tr>
        </thead>
    </table>
    <table class="table-1" border="1" >
      <thead>
        <tr>
          <th>Nombre</th>
          <th><span> {{ $general['arte_pesca'] -> nombre_dispositivo }} </span></th>
        </tr>
        <tr>
          <th>Tamaño</th>
          <th><span> {{ $general['arte_pesca'] -> tamanio }} </span></th>
        </tr>
        <tr>
          <th>Tipo de malla</th>
          <th><span> {{ $general['arte_pesca'] -> tipo_malla }} </span></th>
        </tr>
        <tr>
          <th>Luz de malla</th>
          <th><span> {{ $general['arte_pesca'] -> luz_malla }} </span></th>
        </tr>
        <tr>
          <th>Mitigación bycatch</th>
          <th><span> {{ $general['bitacora'] -> mitigacion }} </span></th>
        </tr>
      </thead>
  </table>

  <!-- BITACORA END ------------------------------------------------------------------------->

    <br>
    <br>


    <!-- LANCES ------------------------------------------------------------------------->
    <table  class="titulo"  border="1" >  
        <thead>
          <tr>
            <th>Detalles de cada lance</th>
          </tr>
        </thead>
    </table>

    @foreach($lances as $lance)

    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>{{ $lance['lance'] }}</th>
          </tr>
        </thead>
    </table>
  <table class="table-2" border="1" >
    <thead>
      <tr>
        <th>Latitud de inicio</th>
        <th><span>{{ $lance['laitud_i'] }}</span></th>
        <th style="width: 120px;">Latitud de final</th>
        <th><span>{{ $lance['laitud_f'] }}</span></th>
      </tr>
      <tr>
        <th>Longitud de inicio</th>
        <th><span>{{ $lance['longitud_i'] }}</span></th>
        <th style="width: 120px;">Longitud de final</th>
        <th><span>{{ $lance['longitud_f'] }}</span></th>
      </tr>
    </thead>
</table>
<table class="table-1" border="1" >
  <thead>
    <tr>
      <th>Temperatura (°C)</th>
      <th><span>{{ $lance['temperatura'] }}</span></th>
    </tr>
    <tr>
      <th>Viento (k/h)</th>
      <th><span>{{ $lance['viento']  }}</span></th>
    </tr>
    <tr>
      <th>Otros</th>
       <th><span>{{ $lance['otro'] }}</span></th>
    </tr>
    <tr>
      <th>Observaciones</th>
       <th><span>{{ $lance['observaciones'] }}</span></th>
    </tr>
  </thead>
</table>

<!-- ESPECIES RETENIDAS ------------------------------------------------------------------------->
<table  class="sub-titulo"  border="1" >
  <thead>
    <tr>
      <th>Especies retenidas</th>
    </tr>
  </thead>
</table>

    <table  border="1" >
        <thead>
          <tr>
            <th style="width: 150px;">Nombre Común</th>
            <th style="width: 150px;">Nombre científico</th>
            <th>Peso total (kg)</th>
            <th>Cajones</th>
            <th>Talla/tamaño</th>
          </tr>
        </thead>

        <tbody>
         
         @foreach($lance['especies_retenidas'] as $especie)

            <tr>
              <td><span>{{ $especie['nombre_comun'] }}</span></td>
              <td><span>{{ $especie['nombre_cientifico'] }}</span></td>
              <td><span>{{ $especie['peso'] }}</span></td>
              <td><span>{{ $especie['cajones'] }}</span></td>
              <td><span>{{ $especie['talla_tamanio'] }}</span></td>
            </tr>

          @endforeach

          </tbody>
    </table>
<!-- ESPECIES RETENIDAS END------------------------------------------------------------------------->
<!-- PESCA INCIDENTAL ------------------------------------------------------------------------->
<table  class="sub-titulo"  border="1" >
  <thead>
    <tr>
      <th>Pesca incidental</th>
    </tr>
  </thead>
</table>

    <table  border="1" >
        <thead>
          <tr>
            <th style="width: 150px;">Nombre Común</th>
            <th style="width: 150px;">Nombre científico</th>
            <th>Peso total (kg)</th>
            <th>Cajones</th>
            <th>Talla/tamaño</th>
          </tr>
        </thead>

        <tbody>
         
         @foreach($lance['pesca_incidental'] as $especie)

            <tr>
              <td><span>{{ $especie['nombre_comun'] }}</span></td>
              <td><span>{{ $especie['nombre_cientifico'] }}</span></td>
              <td><span>{{ $especie['peso'] }}</span></td>
              <td><span>{{ $especie['cajones'] }}</span></td>
              <td><span>{{ $especie['talla_tamanio'] }}</span></td>
            </tr>

          @endforeach

          </tbody>
    </table>
<!-- PESCA INCIDENTAL END------------------------------------------------------------------------->
<table  class="sub-titulo"  border="1" >
  <thead>
    <tr>
      <th>Otras especies (Incidental o Descartada)</th>
    </tr>
  </thead>
</table>

    <table  border="1" >
        <thead>
          <tr>
            <th style="width: 124px; border:none">Tipo de especie</th>
            <th style="width: 150px;">Nombre</th>
            <th style="width: 150px;">Nombre científico</th>
            <th>Detalle</th>
          </tr>
        </thead>

        <tbody>

          @foreach($lance['especies_otras'] as $especie)

            <tr>
                <td><span>{{ $especie['tipo'] }}</span></td>
                <td><span>{{ $especie['nombre_comun'] }}</span></td>
                <td><span>{{ $especie['nombre_cientifico'] }}</span></td>

                @if($especie['tipo'] == 'Incidental')
                  
                  <td><span> {{$especie['unidades']}} U</span></td>
                  
                  @else

                  <td><span>{{$especie['peso']}} KG </span></td>

                @endif
            </tr>

          @endforeach

          </tbody>
    </table>
    @endforeach

    <table  class="titulo"  border="1" >
    <thead>
 
    </thead>
  </table>

  <br>
  <br>

  <table  class="titulo"  border="1" >
    <thead>
      <tr>
        <th>Información adicional</th>
      </tr>
    </thead>
  </table>
    <table class="table-1" border="1" >
      <thead>
        <tr>
          <th >Combustible (lt)</th>
          <th><span> {{ $general['bitacora'] -> combustible }} </span></th>
        </tr>
        <tr>
          <th >Millas recorridas</th>
          <th><span> {{ $general['bitacora'] -> millas_recogidas}} </span></th>
        </tr>
        <tr>
          <th >Total retenido (kg)</th>
          <th><span> {{$procuccion_total_retenidas}} </span></th>
        </tr>
        <tr>
          <th >Producción total (kg)</th>
          <th><span> {{$procuccion_total}} </span></th>
        </tr>
        <tr>
          <th >Observaciones de parte de pesca</th>
          <th><span> {{ $general['bitacora']['observacion_parte_pesca'] }} </span></th>
        </tr>
        <tr>
          <th >Observacion general</th>
          <th><span> {{$general['bitacora']['observaciones_generales']}} </span></th>
        </tr>
      </thead>
  </table>

</body>
</html>