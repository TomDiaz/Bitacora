<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

body { font-family: "Gill Sans Extrabold", Helvetica, sans-serif  }

        table{
          width: 100%;
          font-size: 9px;
          border-collapse: collapse;
          font-family: "Gill Sans Extrabold", Helvetica, sans-serif;
        } 
        
        .table-1 th{
  padding: 10px;
}

.table-1 th:nth-child(1){
    background: #d9d9d9;
  
}

.table-1 th{
    border: black solid 1px;
}

.table-2 th{
  border: solid 1px;
  border-top: none;
  text-align: left;
}

.table-2 th:nth-child(1), .table-3 th:nth-child(1){
  width: 64.3%;
}

.table-2 th:nth-child(2){
  width: 150px;
}

.table-3 th , .table-6 th, .table-7 th{
  border: solid 1px;
  border-top: none;
}

.table-3 td, .table-7 td{
  border: solid 1px;
  font-weight: 600;
  height: 15px;
}

.table-4 th, .table-5 th{
  border: solid 1px;
  border-top: none;
}

.table-4 th, .table-6 th{
  text-align: left;
}

.table-4 th:nth-child(2),.table-4 th:nth-child(4){
    width: 200px;
}

 .table-5 th:nth-child(1){
  width: 300px;
}
.table-7 th
{
  background: #d9d9d9;
}

.table-7 th:nth-child(2){
    border-right: none;
}

.table-7 th:nth-child(3){
    border-left: none;
    border-right: none;
}

.table-7 th:nth-child(4){
    border-left: none;
}
.table-7 tbody tr:nth-child(1)
{
  text-align: center;
}

.table-7 tbody tr:nth-child(1) td:nth-child(1),.table-7 tbody tr:nth-child(1) td:nth-child(5),.table-7 tbody tr:nth-child(1) td:nth-child(6),.table-7 tbody tr:nth-child(1) td:nth-child(7),.table-7 tbody tr:nth-child(1) td:nth-child(8),.table-7 tbody tr:nth-child(1) td:nth-child(9){
   background: #d9d9d9;
}


.table-7 th:nth-child(1),.table-7 th:nth-child(5),.table-7 th:nth-child(6),.table-7 th:nth-child(7),.table-7 th:nth-child(8),.table-7 th:nth-child(9)
{
  border-bottom: #d9d9d9 solid 1px;
  padding-top: 15px
}

span{
    color: blue;
}

    </style>

</head>
<body>
    

    <table  border="1" >
        <thead>
          <tr>
            <th>PARTE DE PESCA BORRADOR – NO ENTREGAR – PARTE DE PESCA BORRADOR – NO ENTREGAR – PARTE DE PESCA BORRADOR – NO ENTREGAR</th>
          </tr>
        </thead>
    </table>

    <table class="table-1" border="1" >
        <thead>
          <tr>
            <th>PARTE DE PESCA BORRADOR - NO ENTREGAR</th>
            <th>HOJA ___ de ___ HOJAS </th>
          </tr>
        </thead>
    </table>
    <table class="table-2" >
        <thead>
          <tr>
            <th></th>
            <th>VIAJE ANUAL Nº</th>
            <th>  </th>
          </tr>
        </thead>
        <thead>
          <tr>
            <th>NOMBRE DE LA EMBARCACION: <span>{{ $data['embarcacion'] -> Nombre}}</span> </th>
            <th>MATRICULA</th>
            <th style="text-align:center"> <span >{{ $data['embarcacion'] -> Matricula}}</span> </th>
          </tr>
        </thead>
        <thead>
          <tr>
            <th>NOMBRE DE LA EMBARCACION PAREJA:</th>
            <th>MATRICULA</th>
            <th>  </th>
          </tr>
        </thead>
        <thead>
          <tr>
            <th>ARMADOR: <span>{{ $data['armador'] -> name}}</span> </th>
            <th>TRIPULANTES</th>
            <th style="text-align:center"> <span>{{ $data['bitacora'] -> tripulantes}}</span> </th>
          </tr>
        </thead>
    </table>
    <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
      
    <table class="table-3" >
        
        <thead>
          <tr>
            <th>PUERTO</th>
            <th>DIA</th>
            <th> MES</th>
            <th> AÑO</th>
            <th> HORA</th>
            <th> MIN</th>
          </tr>
        </thead>

        <tbody>
            <tr>
              <td> ZARPADA: <span>{{ $data['puerto']['zarpe']}}</span></td>
              <td style="text-align:center"> <span>{{ $data['times'][0]['dia'] }}</span> </td>
              <td style="text-align:center"> <span>{{ $data['times'][0]['mes'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][0]['anio'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][0]['hora'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][0]['minuto'] }}</td>
            </tr>
            <tr>
              <td>DESEMBARQUE: <span>{{ $data['puerto']['arribo']}}</span></td>
              <td style="text-align:center"> <span>{{ $data['times'][1]['dia'] }}</span> </td>
              <td style="text-align:center"> <span>{{ $data['times'][1]['mes'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][1]['anio'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][1]['hora'] }}</td>
              <td style="text-align:center"> <span>{{ $data['times'][1]['minuto'] }}</td>
            </tr>
          </tbody>
     </table>
     <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
    <table class="table-4" >
        
        <thead>
          <tr>
            <th>COMBUSTIBLE (Litros)</th>
            <th  style="text-align:center"><span> {{ $data['bitacora'] -> combustible}}</span></th>
            <th>MILLAS RECORRIDAS </th>
            <th  style="text-align:center"> <span>{{ $data['bitacora'] -> millas_recogidas}}</span> </th>
         
          </tr>
        </thead>
      
     </table>
     <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
    <table class="table-5" >
        <thead>
          <tr>
            <th>ARTE PESCA PRINCIPAL</th>
            <th style="text-align:center"> <span>{{ $data['arte_pesca'] -> nombre}}</span></th>
          </tr>
          <tr>
            <th>ARTE PESCA SECUNDARIO</th>
            <th></th>
          </tr>
        </thead>
     </table>

     <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th>DISPOSITIVOS DE SELECTIVIDAD</th>
          </tr>
        </thead>
    </table>
    <table class="table-6" >
        <thead>
          <tr>
            <th>NOMBRE:  <span>{{ $data['arte_pesca'] -> nombre}}</span></th>
            <th>TAMAÑO: <span>{{ $data['arte_pesca'] -> tamanio}}</span></th>
            <th>TIPO DE MALLA: <span>{{ $data['arte_pesca'] -> tipo_malla}}</span></th>
            <th>LUZ DE MALLA: <span>{{ $data['arte_pesca'] -> luz_malla}}</span></th>
          </tr>
       
        </thead>
     </table>
     <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
    <table class="table-7" >
        
        <thead>
          <tr>
            <th>FECHA (dd/mm/aaaa)</th>
            <th></th>
            <th> Rectangulo</th>
            <th> </th>
            <th> LANCES</th>
            <th> HORAS</th>
            <th> ESPECIE</th>
            <th> KILOS</th>
            <th> CAJONES</th>
          </tr>
        </thead>

        <tbody>
            <tr>
              <td></td>
              <td>LAT LONG</td>
              <td>CUADRICULA</td>
              <td>ZONA: P Z F</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            @foreach($data['especies'] as $especie)

            <tr>
              <td style="text-align:center"><span>{{  date("d/m/Y", strtotime( $especie -> fecha_inicial)) }}</span></td>
              <td style="text-align:center"></td>
              <td style="text-align:center"></td>
              <td style="text-align:center"></td>
              <td style="text-align:center"></td>
              <td style="text-align:center"></td>
              <td style="text-align:center"><span>{{ $especie -> nombre }}</span></td>
              <td style="text-align:center"><span>{{ $especie -> kilogramos }}</span></td>
              <td style="text-align:center"> <span>{{ $especie -> cajones }}</span></td>
            </tr>

            @endforeach
           
          </tbody>
     </table>
     <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th style=" text-align: left;">OBSERVACIONES:  <span>{{ $data['bitacora'] -> observaciones}}</span> </th>
          </tr>
        </thead>
    </table>
    <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
    <table  style="border: solid 1px; border-top:none; " >
        <thead>
          <tr>
            <th>CODIGO ZONA P : AGUAS PROVINCIALES (12 MILLAS) Z : ZONA ECONOMICA ARGENTINA (ZEEA) Y ZONA COMUN DE PESCA F : FUERZA ZEEA</th>
          </tr>
        </thead>
    </table>
    <table  style="border: solid 1px; border-top:none;" >
        <thead>
          <tr>
            <th><br></th>
          </tr>
        </thead>
    </table>
    <table  style="border: solid 1px; border-top:none; " >
        <thead>
          <tr>
            <th>Este formulario se utiliza solo para como borrador previo a la carga en el sistema, no debe entregarse a las autoridades, , al llegar a puerto el parte de pesca <br> válido
                sera el que se encuentre cargado en SIFIPA <a href=" https://sifipa.magyp.gob.ar"> https://sifipa.magyp.gob.ar</a>
                 
            </th>
          </tr>
        </thead>
    </table>
    <table   style="border: solid 1px; border-top:none; ">
        <thead>
          <tr >
            <th style="padding-top: 40px !important;">PARTE DE PESCA BORRADOR – NO ENTREGAR – PARTE DE PESCA BORRADOR – NO ENTREGAR – PARTE DE PESCA BORRADOR – NO ENTREGAR</th>
          </tr>
        </thead>
    </table>
</body>
</html>