grafico()

async function grafico(){

const cantidad = 4 

let kilogramos = await fetch('/especies/' + cantidad)
.then( res => res.json())
.then( data => {
     return data
 })

 console.log(kilogramos)


const data = {
  labels: getMeses(cantidad).reverse(),
  datasets: [{
    label: 'Especies Retenidas',
    backgroundColor: 'rgb(54, 162, 235)',
    data: kilogramos.reverse(),
  }]
};

const config = {
  type: 'bar',
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


}

  function getMeses(cant){

    const fecha = new Date()

    let contador = fecha.getMonth()
    let meses_index = []

    const meses = [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
           'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    
    for( let i = 0; i < cant; i++){
      
      if(contador == -1){
        contador = 11;
      }
     
      meses_index.push(meses[contador--])
    }

    //console.log(meses_index.reverse())

    return meses_index

  }


