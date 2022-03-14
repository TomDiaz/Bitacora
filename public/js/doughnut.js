
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
  labels: ['Retenidas', 'Incidentales', 'Descarte'],
  datasets: [{
    label: 'Especies Retenidas',
    backgroundColor: ['rgb( 171, 235, 198)','rgb( 250, 215, 160 )','rgb( 241, 148, 138 )'],
    data: [10,20,10],
  }]
};

const config = {
  type: 'doughnut',
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




