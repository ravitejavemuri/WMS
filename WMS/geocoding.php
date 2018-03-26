<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="wms.css">
		<style>
			.chart-container {
				width: 640px;
				height: auto;
				
				
			}
		</style>
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>

</head>
<body onload="GetAddress()">

<h3 id="Loc" class="well text-center "></h3>

<div id="nav">
 
  <button type="button" class="button button2 responsive-width" onclick="pH()">pH</button></br>
  <button type="button" class="button button3 responsive-width" onclick="Con()" >Conductivity</button></br>
<button type="button" class="button button4 responsive-width" onclick="Turb()">Turbidity</button></br>

<a href="index.php"><button type="button" class="button button4 responsive-width" >Back</button></br></a>
</div>

<div class="chart-container center-block well-lg">
			<canvas id="mycanvas"></canvas>
		</div>


    <?php
  //$deli=0.000001;
	//$db=mysqli_connect("localhost","id1087204_teamwms","teamwms","id1087204_megamount")or die("unable to connect");
	$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");
	//$con=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel");
	
	

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($db,"SELECT * FROM `sense` WHERE pH is NOT NULL ORDER BY Time DESC LIMIT 1");
	
	while($row = mysqli_fetch_array($result))
	{
		$latm[]=$row['Latitude'];
		//$latm=$row['Lat'];
		$ph[] = $row['pH'];
		//$latm=$latm*$deli;
		//$lam=$row['Long'];
		$lam[]=$row['Longitude'];//for local host
		//$lam=$lam*$deli;
	}
	

	
	?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyABUlAOWtwKMnT9biF_OkMCb6pFmCLtnFs&callback=GetAddress"></script>
   
   <script type="text/javascript">
        function GetAddress() {
			//17.4239074	78.4728247
            var lat = <?php echo json_encode($latm[0]); ?>;
            var lng = <?php echo json_encode($lam[0]); ?>;
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
						//document.getElementById("Loc").innerHTML="Location: " + results[1].formatted_address;
						return results[1];
				   }
                }
            });
        }
		
		function pH(){
			$(document).ready(function(){
	$.ajax({
		url: "http://dive.in/wms/check.php",
		method: "GET",
		success: function x(data) {
			console.log(data);
			var pH = [];
			var Time = [];

			for(var i in data) {
				Time.push(" " + data[i].Time);
				pH.push(data[i].pH);
			}

			var chartdata = {
				labels: Time,
				datasets : [
					{
						label: 'pH',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
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
			
			
			
		}
		
		function Con()
		{
			$(document).ready(function(){
	$.ajax({
		url: "http://dive.in/wms/check.php",
		method: "GET",
		success: function y (data) {
			console.log(data);
			var Conduct = [];
			var Time = [];

			for(var i in data) {
				Time.push(" " + data[i].Time);
				Conduct.push(data[i].Conduct);
			}

			var chartdata = {
				labels: Time,
				datasets : [
					{
						label: 'Conductivity',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data:Conduct
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
			
		}
		
		function Turb()
		{
			$(document).ready(function(){
	$.ajax({
		url: "http://dive.in/wms/check.php",
		method: "GET",
		success: function z (data) {
			console.log(data);
			var Turbidity = [];
			var Time = [];

			for(var i in data) {
				Time.push(" " + data[i].Time);
				Turbidity.push(data[i].Turbidity);
			}

			var chartdata = {
				labels: Time,
				datasets : [
					{
						label: 'Turbidity',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data:Turbidity
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
		}
    </script>
</body>
</html>