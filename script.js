async function fetchData() {
    try {
        const response = await fetch('http://localhost/Project/codes/datafetch.php');
      const data = await response.json();
  
      console.log(data);
  
      processData(data);
    } catch (error) {
      console.error('Error fetching data:', error.message);
    }
  }
  
  function processData(data) {
    // Your processing logic here
    const chartData = {
      labels: data.map(item => item.taskname),
      data: data.map(item => item.timetaken),
    };
  
    // Now use the dynamic chartData to create the doughnut chart and populate UL
    createDoughnutChart(chartData);
    populateUl(chartData);
  }
  
  // function createDoughnutChart(chartData) {
  //   const myChart = document.querySelector(".my-chart");
  
  //   new Chart(myChart, {
  //     type: "doughnut",
  //     data: {
  //       labels: chartData.labels,
  //       datasets: [
  //         {
  //           label: "Time spent",
  //           data: chartData.data,
  //         },
  //       ],
  //     },
  //     options: {
  //       borderWidth: 10,
  //       borderRadius: 2,
  //       hoverBorderWidth: 0,
  //       plugins: {
  //         legend: {
  //           display: false,
  //         },
  //       },
  //     },
  //   });
  // }


  function createDoughnutChart(chartData) {
    const myChart = document.querySelector(".my-chart");
  
    new Chart(myChart, {
      type: "doughnut",
      data: {
        labels: chartData.labels,
        datasets: [
          {
            label: "Time spent",
            data: chartData.data,
          },
        ],
      },
      options: {
        borderWidth: 10,
        borderRadius: 2,
        hoverBorderWidth: 0,
        plugins: {
          legend: {
            display: false,
          },
        },
        tooltips: {
          enabled: false, 
        },
      },
    });
  }
  
  
  const ul = document.querySelector(".programming-stats .details ul");
  
  const populateUl = (chartData) => {
    chartData.labels.forEach((label, i) => {
      let li = document.createElement("li");
      li.innerHTML = `${label}: <span class='percentage'>${chartData.data[i]}sec</span>`;
      ul.appendChild(li);
    });
  }
  
  // Call the fetchData function when the script is loaded
  fetchData();
  
  