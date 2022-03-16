
grafico()

async function grafico(){


 let retenida = $(".retenida").attr("valor")
 let incidental = $(".incidental").attr("valor")
 let descarte = $(".descarte").attr("valor")

const data = {
  labels: ['Retenidas', 'Incidentales', 'Descarte'],
  datasets: [{
    label: 'Especies Retenidas',
    backgroundColor: ['rgb( 171, 235, 198)','rgb( 250, 215, 160 )','rgb( 241, 148, 138 )'],
    data: [retenida,incidental,descarte],
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




