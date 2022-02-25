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
