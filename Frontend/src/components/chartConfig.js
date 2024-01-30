// export const data = {
//     labels: ['Correct', 'Wrong'],
//     datasets: [
//         {
//             backgroundColor: ['#4B9AFA', '#FF9D01'],
//             data: [40, 20]
//         }
//     ]
// }

// export const options = {
//     responsive: true,
//     maintainAspectRatio: false,
//     borderWidth: 0,
//     plugins: {
//         legend: {
//             display: false, // Set this to false to hide the legends
//         },
//     },
// }


export const data = {
    labels: ['Correct', 'Wrong'],
    datasets: [
      {
        backgroundColor: ['#4B9AFA', '#FF9D01'],
        data: [0, 0], // Initial values, will be updated dynamically
      },
    ],
  };
  
  export const options = {
    responsive: true,
    maintainAspectRatio: false,
    borderWidth: 0,
    plugins: {
      legend: {
        display: false,
      },
    },
  };