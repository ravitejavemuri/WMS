<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
body { margin: 20; padding: 20; overflow:hidden; }
#map_canvas{
	width: 100%;
	height: 620px;
}
.tooltip { position:absolute;
	width: 120px;
	padding: 5px;
	border: 2px solid #000;
	border-radius:8%;
	font-size: 9pt;
	font-family: Verdana;
	background-color: #545454;
	color: #fff;
}
</style>
<?php
  //$deli=0.000001;
	
	$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");
	
	
	

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
	}
	

	
	?>
<script type="text/javascript">
    function initialize() 
	{
		var Lat = <?php echo json_encode($latm); ?>;
		var lng = <?php echo json_encode($lam); ?>;
		var ph = <?php echo json_encode($ph); ?>;
	  
        var mapOptions = {
          center: new google.maps.LatLng(20.5937, 78.9629),
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
     	
		
		var marker, i;
		for (i = 0; i < Lat.length; i++) 
		{  
			if((ph[i] > 0.0 && ph[i] < 2.5) || (ph[i] > 11.5 && ph[i] < 14.0))
			{
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(Lat[i], lng[i]),
					icon: pinSymbol("#FF0000"),
					map: map,
					tooltip1: '<B>Pollution Level: <span style="color:#ff0000;">Extreme</span></B>'
				});
					  
				var tooltip1 = new Tooltip({map: map}, marker);
				tooltip1.bindTo("text", marker, "tooltip1");
				google.maps.event.addListener(marker, 'mouseover', function() {
					tooltip1.addTip();
					tooltip1.getPos2(marker.getPosition());
				});
			}
			else if(ph[i] > 6.5 && ph[i] < 8.5)
			{
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(Lat[i], lng[i]),
					icon: pinSymbol("#008000"),
					map: map,
					tooltip2: '<B>Pollution Level: <span style="color:#83F52C;">In Control</span></B>'
				});
					  
				var tooltip2 = new Tooltip({map: map}, marker);
				tooltip2.bindTo("text", marker, "tooltip2");
				google.maps.event.addListener(marker, 'mouseover', function() {
					tooltip2.addTip();
					tooltip2.getPos2(marker.getPosition());
				});
			}
			else if((ph[i] > 2.5 && ph[i] < 6.5) || (ph[i] > 8.5 && ph[i] < 11.5))
			{
				marker = new google.maps.Marker({
					 position: new google.maps.LatLng(Lat[i], lng[i]),
					icon: pinSymbol("#FFFF00"),
					map: map,
					tooltip: '<B>Pollution Level: <span style="color:#FFFF00;">Moderate</span></B>'
				});
					  
				var tooltip = new Tooltip({map: map}, marker);
				tooltip.bindTo("text", marker, "tooltip");
				google.maps.event.addListener(marker, 'mouseover', function() {
					tooltip.addTip();
					tooltip.getPos2(marker.getPosition());
				});
			}
			
			google.maps.event.addListener(marker, 'mouseout', function() {
					tooltip.removeTip();
				});
			google.maps.event.addListener(marker, 'mouseout', function() {
					tooltip1.removeTip();
				});
			google.maps.event.addListener(marker, 'mouseout', function() {
					tooltip2.removeTip();
				});
			google.maps.event.addListener(marker, 'click', function() {
					var latitude = this.position.lat();
					var longitude = this.position.lng();
					window.location.href = "demo.php?"+latitude+"&"+longitude;
				});
		}
    }
	  
	  
	function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 1.5,
        scale: 1,
   };
}
</script>
</head>
<body onload="initialize()">
<p id="Loc"> </p>
<script src="https://maps.googleapis.com/maps/api/js?key=
&callback=initialize"></script>
	<script type="text/javascript" src="custom_map_tooltip.js"></script>
<div id="map_canvas"></div>
<div id="sample"></div>
</body>
</html>
