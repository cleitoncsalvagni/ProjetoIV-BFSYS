// Set new default font family and font color to mimic Bootstrap's default styling

(Chart.defaults.global.defaultFontFamily = "Nunito"),
	'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

const servico = parseFloat(faturamento.servico.replace(/,/g, ""));
const produto = parseFloat(faturamento.produto.replace(/,/g, ""));
const total = servico + produto;

function formatToPercent(number, total) {
	const percent = (number / total) * 100;
	return percent.toFixed(2) + "%";
}

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
	type: "doughnut",
	data: {
		labels: ["Serviços", "Produtos"],
		datasets: [
			{
				data: [
					faturamento.servico.replace(/,/g, ""),
					faturamento.produto.replace(/,/g, ""),
				],
				backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
			callbacks: {
				label: function (tooltipItem, data) {
					var label = data.labels[tooltipItem.index] || "";
					if (label) {
						label += ": ";
					}
					label += formatToPercent(
						data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index],
						total
					);
					return label;
				},
			},
		},
		legend: {
			display: true,
		},
		cutoutPercentage: 80,
	},
});
