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
   border-top: none
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

.table-4 th:nth-child(1){
  width: 50.3%;
}

.lance th:nth-child(1), .lance th:nth-child(3){
  width: 30%;
}

.login-logo img{
  width: 100px;
  display: block;
  margin: auto;
  padding: 20px;
  margin-top: -30px;
}

.login-logo{
  text-align: center;
}
.login-logo h3{
  margin-top: -10px;
  fotn-weight: 200;
}

span{
    color: #303030;
    
}
        
    </style>

</head>
<body>

            <div class="login-logo">
               <img src="vendor/adminlte/dist/img/logo.png" alt="">
               <h3>REPRESENTACIÓN IMPRESA <br> DE BITÁCORA ELECTRÓNICA DE PESCA ARGENTINA</h3>
            </div>

    
    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>INFORMACIÓN GENERAL</th>
          </tr>
        </thead>
    </table>
    <table class="table-1" border="1" >
        <thead>
          <tr>
            <th>ARMADOR</th>
            <th>{{ $general['armador'] }}</th>
          </tr>
          <tr>
            <th>EMBARCACIÓN</th>
            <th> <span>{{ $general['embarcacion'] -> Nombre}}</span> </th>
          </tr>
          <tr>
            <th>MATRICULA</th>
            <th><span>{{ $general['embarcacion'] -> Matricula}}</span> </th>
          </tr>
          <tr>
            <th>PERMISO PESCA</th>
            <th><span>{{ $general['embarcacion'] -> PermisoPesca}}</span> </th>
          </tr>
          <tr>
            <th>CAPITAN</th>
            <th><span>{{ $general['capitan']}}</span> </th>
          </tr>
        </thead>
    </table>

    <br>
    <br>

 
    <table class="table-3 titulo" border="1" >
        <thead>
          <tr>
            <th>BITÁCORA</th>
            <th>FECHA HORA</th>
            <th>PUERTO</th>
          </tr>
        </thead>
    </table>
    <table class="table-2" border="1" >
        <thead>
          <tr>
            <th>INICO</th>
            <th><span>{{ date("d/m/Y", strtotime($general['inico']))}}</span></th>
            <th>ZARPE</th>
            <th><span>{{ $general['zarpe']}}</span></th>
          </tr>
          <tr>
            <th>CIERRE</th>
            <th><span>{{ date("d/m/Y", strtotime($general['cierre']))}}</span></th>
            <th>DESEMBARQUE</th>
            <th><span>{{ $general['arribo']}}</span></th>
          </tr>
        </thead>
    </table>
    <table class="table-1" border="1" >
        <thead>
          <tr>
            <th>TOTAL DE LANCES</th>
            <th><span>{{ $general['total_lances']}}</span></th>
          </tr>
        </thead>
    </table>

    <!-- <br>
    <br>
    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>PESCA TOTAL POR ESPECIES</th>
          </tr>
        </thead>
    </table>
    <table class="table-4 titulo" border="1" >
        <thead>
          <tr>
            <th>ESPECIE</th>
            <th>CAPTURA</th>
          </tr>
        </thead>
    </table>
    <table  border="1" >
        <thead>
          <tr>
            <th>Nombre Común</th>
            <th>Nombre Cientifico</th>
            <th>Peso Total</th>
            <th>Cantidad (#individuos)</th>
          </tr>
        </thead>

        <tbody>
            <tr>
              <td>1</td>
              <td>22</td>
              <td>2</td>
              <td>2</td>
            </tr>
          </tbody>
    </table> -->

    <br>
    <br>
    <table  class="titulo"  border="1" >
        <thead>
          <tr>
            <th>DETALLE DE LANCES</th>
          </tr>
        </thead>
    </table>

    @foreach($lances as $lance)

    <table class="table-2 lance" border="1" >
        <thead>
          <tr>
            <th>LANCE #</th>
            <th><span>{{$lance['lance']}}</span></th>
            <th>ARTE PESCA</th>
             <th><span>{{$lance['arte_pesca']}}</span></th>
          </tr>
          <tr>
            <th>ZONA DE PESCA</th>
             <th><span>{{$lance['zona_pesca']}}</span></th>
            <th>CANTIDAD ARTES DE PESCA</th>
             <th><span> 1 </span></th>
          </tr>
          <tr>
            <th>INICIO</th>
             <th><span>{{ date("d/m/Y", strtotime($lance['inico']))}}</span></th>
            <th>FIN</th>
             <th><span>{{ date("d/m/Y", strtotime($lance['fin']))}}</span></th>
          </tr>
          <tr>
            <th>Latitud (dd mm.mmm)</th>
             <th><span>{{$lance['laitud_i']}}</span></th>
            <th>Latitud (dd mm.mmm)</th>
             <th><span>{{$lance['laitud_f']}}</span></th>
          </tr>
          <tr>
            <th>Longitud (dd mm.mmm)</th>
             <th><span>{{$lance['longitud_i']}}</span></th>
            <th>Longitud (dd mm.mmm)</th>
             <th><span>{{$lance['longitud_f']}}</span></th>
          </tr>
        </thead>
    </table>
    <table class="table-4 titulo" border="1" >
        <thead>
          <tr>
            <th>ESPECIE</th>
            <th>CAPTURA</th>
          </tr>
        </thead>
    </table>
    <table  border="1" >
        <thead>
          <tr>
            <th>Nombre Común</th>
            <th>Nombre Cientifico</th>
            <th>Peso Total</th>
            <th>Cantidad (#individuos)</th>
          </tr>
        </thead>


        @foreach($lance['especies'] as $especie)

         <tbody>
            <tr>
              <td><span>{{$especie['nombre_comun']}}</span></td>
              <td><span>{{$especie['nombre_cientifico']}}</span></td>
              <td><span>{{$especie['peso']}}</span></td>
              <td><span>{{$especie['cantidad']}}</span></td>
            </tr>
          </tbody>

        @endforeach

    </table>


    @endforeach
    
    <br>
    <br>
    <br>
    <table border="1" >
        <thead >
          <tr>
            <th class="titulo">OBSERVACIONES</th>
            <th><span>{{ $general['obsevaciones']}}</span</th>
          </tr>
        </thead>

  
    </table>

</body>
</html>