<?php
$servername = "localhost";
$database = "webbanhang";
$user = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $user, $password, $database);

if ($conn){
	mysqli_query($conn,"SET NAMES 'UTF8'");    
}
else{
	echo('Kết nối thất bại');
}