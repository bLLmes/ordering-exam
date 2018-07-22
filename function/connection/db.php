<?php

$host 		= "localhost";
$user 		= "root";
$password 	= "";
$db_name 	= "db_pizza";

$con 		= new mysqli($host, $user, $password, $db_name);
if($con->connect_errno){
	echo "Connection error";
}

?>