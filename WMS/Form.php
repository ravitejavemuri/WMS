<?php
  //$deli=0.000001;
	//$db=mysqli_connect("localhost","id1087204_teamwms","teamwms","id1087204_megamount")or die("unable to connect");
	$db=mysqli_connect("dive.in","root","","megamount")or die("unable to connect");
	//$con=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel");
	

$nam=mysqli_real_escape_string($db,$_GET['name']);
$nameorg=mysqli_real_escape_string($db,$_GET['nameorg']);
$email=mysqli_real_escape_string($db,$_GET['email']);
$Type=mysqli_real_escape_string($db,$_GET['Type']);
$num=mysqli_real_escape_string($db,$_GET['num']);
$web=mysqli_real_escape_string($db,$_GET['web']);
	

	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result=

 
 
 
 
 
 ?>