const cCtx = $('#barChart')
new Chart(cCtx, {
    type:'line',
	data: {
      labels: ['初心者','素人', '普通の人', '達人', '超人],
            datasets: [{
	 	label: '最高気温(度）',
<<<<<<< HEAD
	    data: [35, 34, 35, 34, 25],
	    borderColor: "rgba(255,0,0,1)",
	    backgroundColor: "rgba(0,0,0,0,0,0)"
	    }],
=======
	    data: [35, 34, 37, 35, 34, 35, 34],
	    borderColor: "rgba(255,0,0,1)",
	    backgroundColor: "rgba(0,0,0,0,0,0)"
	    },
	  ],
>>>>>>> kayo_index
},
	options: {
		scales: {
			yAxes: [{
				ticks: {

					//グラフの最小値を0にする
					beginAtZero: true
				}
			}]
		}
	}
})