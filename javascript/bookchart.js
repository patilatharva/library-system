$(document).ready(function(){
	$.ajax({
		url : "../php/chartjs/bookChart.php",
		type : "GET",
		success : function(json){
			data = JSON.parse(json);

			var month = [];
			var copies = [];

			for(var i in data) {
				month.push(data[i].month);
				copies.push(data[i].copies);
			}

			var chart = document.getElementById('mycanvas').getContext('2d'),
			gradient = chart.createLinearGradient(0, 0, 0, 450);
			gradient.addColorStop(0, 'rgba(65, 105, 225, 0.4)');
			gradient.addColorStop(0.4, 'rgba(65, 105, 225, 0.2)');
			gradient.addColorStop(0.6, 'rgba(65, 105, 225, 0.1)');
			gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

			var chartdata = {
				labels: month,
				datasets: [
					{
						label: "Copies",
						fill: true,
						backgroundColor: gradient, //"rgba(65, 105, 225, 0.75)",
						borderColor: "royalblue",
						borderWidth: 3.5,
						pointRadius: 2.5,
						pointBackgroundColor: "royalblue",
						pointHoverBackgroundColor: "royalblue",
						pointHoverBorderColor: "royalblue",
						data: copies
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					responsive: true,
					maintainAspectRatio: false,
					bezierCurve: true,
					scales: {
						xAxes: [{
							gridLines: {
								display: false,
								drawTicks: false
							},
							ticks: {
								padding: 15
							}
						}],
						yAxes: [{
							gridLines: {
								drawTicks: false,
							},
							ticks: {
								padding: 15
							}
						}]
					},
					legend: {
						display: false
					}
				}
			});
		},
		error : function(data) {

		}
	});
});