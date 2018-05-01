<html>
<head>
<style>
	*
	{
		margin-left:1%;
		margin-right:1%;
	}
	header
	{
		margin:0;
		background:#000;
		height:100px;
		text-align:center;
	}
	#Landmark
	{
		font-size:30px;
		color:#fff;
		line-height:100px;
		font-family:Trebuchet MS;
	}
	.bar
	{
		text-align:center;
		margin:0;
		margin-top:20px;
		width:100%;
		background:transparent;
	}
	.bar button
	{
		margin-right:25%;
		width:200px;
		height:60px;
		font-size:20px;
		color:#fff;
		background:#2c57a6;
		border:2px solid #000;
		
		transition:0.3s all;
	}
	.bar button:hover
	{
		cursor:pointer;
		background:#f9943d;
		border:2px solid #000;
	}
	.bar button.active
	{
		background:#10b8b0;
	}
	.bar button:first-child
	{
		margin-left:0px;
	}
	.bar button:last-child
	{
		margin-right:0px;
	}
	
</style>
<?php
  //$deli=0.000001;
	//$db=mysqli_connect("localhost","id1087204_teamwms","teamwms","id1087204_megamount")or die("unable to connect");
	$db=mysqli_connect("localhost","root","","megamount")or die("unable to connect");
	//$con=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel");
	
	

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($db,"SELECT * FROM `Sense` WHERE pH is NOT NULL ORDER BY Time");
	
	while($row = mysqli_fetch_array($result))
	{
		$latm[]=$row['Latitude'];
		//$latm=$row['Lat'];
		$ph[] = $row['pH'];
		//$latm=$latm*$deli;
		//$lam=$row['Long'];
		$lam[]=$row['Longitude'];//for local host
		//$lam=$lam*$deli;
		$turb[]=$row['Turbidity'];
		$con[]=$row['Conduct'];
	}

	?>
</head>
<body>
<header>
<div id="Landmark"></div>
<div class="bar">
    <button class="w3-bar-item w3-button tablink active" onclick="openCity(event,'London')">pH Level</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">Turbidity</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Tokyo')">Conductivity</button>
  </div>
  
  <div id="London" class="w3-container w3-border city">
    <h2>pH Level</h2>
    <p></p>
  </div>

  <div id="Paris" class="w3-container w3-border city" style="display:none">
    <h2>Turbidity</h2>
    <p></p> 
  </div>

  <div id="Tokyo" class="w3-container w3-border city" style="display:none">
    <h2>Conductivity</h2>
    <p></p>
  </div>
</div>
</header>
<script>

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
	
	var url = window.location.href;
	var params = url.split('?');
	var str = params[1];
			
	var andsplit = str.split('&');

	var Lat = andsplit[0];
	var Lng = andsplit[1];
	
	var Latitude = <?php echo json_encode($latm);?>;
	var Longitude = <?php echo json_encode($lam); ?>;
	var ph = <?php echo json_encode($ph); ?>;
	var Conductivity = <?php echo json_encode($con);?>;
	var Turbidity = <?php echo json_encode($turb); ?>;

	function GetAddress() {
			
            var url = window.location.href;
			var params = url.split('?');
			var str = params[1];
			
			var andsplit = str.split('&');

			var Lat = andsplit[0];
			var Lng = andsplit[1];
			
			var latlng = new google.maps.LatLng(Lat, Lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
						document.getElementById("Landmark").innerHTML = (results[0].formatted_address);
                    }
                }
            });			
	}
	/*
	for(i=0;i<Latitude.length;i++)
	{
		if(Latitude[i] === Lat)
		{
			if(ph[i])
			{
				document.write(ph[i]);
			}
			else
			{
				document.write("-");
			}
			if(Conductivity[i])
			{
				document.write(Conductivity[i]);
			}
			else
			{
				document.write("-");
			}
			if(Turbidity[i])
			{
				document.write(Turbidity[i]);
			}
			else
			{
				document.write("-");
			}
		}
	}
	*/
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=cxcxxxxxxxxxxxxxKe22y
&callback=GetAddress"></script>


</body>
</html>
