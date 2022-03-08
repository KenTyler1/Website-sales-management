<?php 
	require_once("db_connect.php");

	$ms_hh = $_GET['ms_hh'];
	$sql_img = "DELETE  FROM `hinhhanghoa` WHERE mshh = $ms_hh";
	$query_img = mysqli_query($conn,$sql_img);


	$sql_hh = "DELETE  FROM `hanghoa` WHERE mshh = $ms_hh";
	$query_hh = mysqli_query($conn,$sql_hh);	
	echo "<script>alert('Hàng hóa đã được xóa...!')</script>";
    echo "<script>window.location = 'product.php'</script>";

?>
<?php 
	$ms_kh = $_GET['mskh'];

	$sql_dc = "DELETE  FROM `diachikh` WHERE mskh = $ms_kh";
	$query_dc = mysqli_query($conn,$sql_kh);

	$sql_kh = "DELETE  FROM `khachhang` WHERE mskh = $ms_kh";
	$query_kh = mysqli_query($conn,$sql_kh);
	echo "<script>alert('Tài khoản khách hàng đã xóa...!')</script>";
    echo "<script>window.location = 'account.php'</script>";


?>

