$(document).ready(function(){
	$.ajax({
		url : "http://dive.in/wms/check.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var Time = [];
			var pH = []; 
			var Turbidity = [];
			var Conduct= [];

			for(var i in data) {
				Time.push("" + data[i].Time);
				pH.push(data[i].pH);
				Turbidity.push(data[i].Turbidity);
				Conduct.push(data[i].Conduct);
			}

			var chartdata = {
				labels:Time,
				datasets: [
					{
						label: "pH",
						fill: true,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: pH
					},
					{
						label: "Turbidity",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: Turbidity
					},
					{
						label: "Conduct",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(211, 72, 54, 0.75)",
						borderColor: "rgba(211, 72, 54, 1)",
						pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
						pointHoverBorderColor: "rgba(211, 72, 54, 1)",
						data: Conduct
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});