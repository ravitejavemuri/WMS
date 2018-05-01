<?php
//setting header to json
header('Content-Type: application/json');
//database
//$db=mysqli_connect("mysql7.000webhost.com","a9317919_ravi","raviiot8","a9317919_steel")or die("unable to connect");

define('DB_HOST', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', 'r');
define('DB_NAME', '');
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
//query to get data from the table
$query = sprintf("SELECT 	Temperature	,Door count,	Product sense ,timestamp  FROM data");
//execute query
$result = $mysqli->query($query);
//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);
?>
