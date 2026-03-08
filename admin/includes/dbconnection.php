<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "mandera";

$conn = mysqli_connect($host, $username, $password, $database);

if($conn)
{
	//echo "Connection successful";
}
else
{
	echo "Connection failed!";
}

?>