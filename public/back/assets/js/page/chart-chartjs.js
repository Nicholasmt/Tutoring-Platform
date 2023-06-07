"use strict";


var draw = Chart.controllers.line.prototype.draw;
Chart.controllers.lineShadow = Chart.controllers.line.extend({
	draw: function () {
		draw.apply(this, arguments);
		var ctx = this.chart.chart.ctx;
		var _stroke = ctx.stroke;
		ctx.stroke = function () {
			ctx.save();
			ctx.shadowColor = '#00000075';
			ctx.shadowBlur = 10;
			ctx.shadowOffsetX = 8;
			ctx.shadowOffsetY = 8;
			_stroke.apply(this, arguments)
			ctx.restore();
		}
	}
});

 

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: y_data,
		datasets: [{
			label: 'views',
			data: x_data,
			borderWidth: 2,
			backgroundColor: '#6777ef',
			borderColor: '#6777ef',
			borderWidth: 2.5,
			pointBackgroundColor: '#ffffff',
			pointRadius: 4
		}]
	},
	options: {
		legend: {
			display: false
		},
		scales: {
			yAxes: [{
				gridLines: {
					drawBorder: false,
					color: '#f2f2f2',
				},
				ticks: {
					beginAtZero: true,
					stepSize: 200,
					fontColor: "#9aa0ac", // Font Color
				}
			}],
			xAxes: [{
				ticks: {
					display: true
				},
				gridLines: {
					display: false
				}
			}]
		},
	}
});

 
 

 