<?php
$server="localhost";
$user="root";
$pass="";
$database="kiots";

$con=mysqli_connect($server,$user,$pass,$database);

if(!$con) {
die(mysqli_error($con));	
}


?>