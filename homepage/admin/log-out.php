<?php 
	session_start();
	unset($_SESSION['msnv']);
	unset($_SESSION['permission']);
	header("location:../index.php");
?>