<html>
<head><title>Storing...</title></head>
<body>
<?php

//$db=mysqli_connect("localhost","id1087204_teamwms","teamwms","id1087204_megamount")or die("unable to connect");
//$db=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel")or die("unable to connect");
$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");

$pH=mysqli_real_escape_string($db,$_POST['pH']);
$Turb=mysqli_real_escape_string($db,$_POST['Turb']);
$Con=mysqli_real_escape_string($db,$_POST['Con']);
$Lat=mysqli_real_escape_string($db,$_POST['Lat']);
$Long=mysqli_real_escape_string($db,$_POST['Long']);


$sql="INSERT INTO `Sense`(`pH`,`Turbidity`,`Conduct`,`Latitude`,`Longitude`) VALUES ('$pH','$Turb','$Con','$Lat','$Long')";
$varr=mysqli_query($db,$sql);
if($varr)
	echo "data stored";
else	
	echo " data not stored"; 
	
mysqli_close($db);	
?>

</body>
</html>