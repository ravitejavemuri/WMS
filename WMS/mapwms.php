<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        width: 100%;
        height: 700px;
      }
    </style>
  </head>
  <body>
  <?php
  //$deli=0.000001;
	
	$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");
	

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($db,"SELECT * FROM `Sense` WHERE pH is NOT NULL ORDER BY Time DESC LIMIT 1");
	
	while($row = mysqli_fetch_array($result))
	{
		$latm=$row['Latitude'];
		//$latm=$row['Lat'];
		
		//$latm=$latm*$deli;
		//$lam=$row['Long'];
		$lam=$row['Longitude'];//for local host
		//$lam=$lam*$deli;
				
	}
	
	?>
     <div id="map"></div>
    <script>
    function initMap() {
  var myLatLng = {lat:<?php echo $latm;?>, lng: <?php echo $lam;?>};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Asset1'

  });
  google.maps.event.addListener(marker, "click", function() {     
	window.open("http://webuildsmartindia.000webhostapp.com/index.html","_self");
  
});
}

	  
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=
&callback=initMap">
    </script>
