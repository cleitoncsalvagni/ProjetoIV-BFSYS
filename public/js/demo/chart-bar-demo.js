(Chart.defaults.global.defaultFontFamily = "Nunito"),
	'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number) {
	return Number.parseFloat(number).toLocaleString("pt-BR", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
}

var dataProdutos = [];
soma_vendas_mes.forEach(function (valor) {
	dataProdutos.push(parseInt(valor));
});

var dataServicos = [];
soma_os_mes.forEach(function (valor) {
	dataServicos.push(parseInt(valor));
});

var ctx = document.getElementById("myVerticalBar");
var myBarChart = new Chart(ctx, {
	type: "bar",
	data: {
		labels: [
			"Jan",
			"Fev",
			"Mar",
			"Abr",
			"Mai",
			"Jun",
			"Jul",
			"Ago",
			"Set",
			"Out",
			"Nov",
			"Dez",
		],
		datasets: [
			{
				label: "Serviços",
				data: dataServicos,
				borderColor: "#4e73df",
				backgroundColor: "#4e73df",
				hoverBackgroundColor: "#2e59d9",
			},
			{
				label: "Produtos",
				data: dataProdutos,
				borderColor: "#1cc88a",
				backgroundColor: "#1cc88a",
				hoverBackgroundColor: "#17a673",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		layout: {
			padding: {
				left: 10,
				right: 25,
				top: 25,
				bottom: 0,
			},
		},
		scales: {
			xAxes: [
				{
					time: {
						unit: "month",
					},
					gridLines: {
						display: false,
						drawBorder: false,
					},
					ticks: {
						maxTicksLimit: 10,
					},
					maxBarThickness: 25,
				},
			],
			yAxes: [
				{
					ticks: {
						min: 0,
						maxTicksLimit: 5,
						padding: 10,
						callback: function (value, index, values) {
							return "R$ " + number_format(value);
						},
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2],
					},
				},
			],
		},
		legend: {
			display: true,
		},
		tooltips: {
			titleMarginBottom: 10,
			titleFontColor: "#6e707e",
			titleFontSize: 14,
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
			callbacks: {
				label: function (tooltipItem, chart) {
					var datasetLabel =
						chart.datasets[tooltipItem.datasetIndex].label || "";

					return datasetLabel + ": R$ " + number_format(tooltipItem.yLabel);
				},
			},
		},
	},
});
