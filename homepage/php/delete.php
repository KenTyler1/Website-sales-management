<?php 
	
	require_once("../admin/db_connect.php");

   	$ms_hh = $_GET['ms_hh'];
   	$sql = "DELETE  FROM `chitietdathang` WHERE mshh = $ms_hh";
	$query = mysqli_query($conn,$sql);
	

	echo "<script>alert('Đơn hàng đã được xóa...!')</script>";
    echo "<script>window.location = '../purchase.php'</script>";

?>