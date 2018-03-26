$(document).ready(function(){
	$.ajax({
		url: "http://dive.in/wms/check.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var Time = [];
			var pH = [];
			var Turbidity = [];
			

			for(var i in data) {
				Time.push("Time " + data[i].Time);
				pH.push(data[i].pH);
			}

			var chartdata = {
				labels: Time,
				datasets : [
					{
						label: 'pH',
						backgroundColor: 'rgba(50, 20, 25, 3)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: pH
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});