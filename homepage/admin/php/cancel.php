<?php 
	
	session_start();

	unset($_SESSION['permission']);
	echo "<script>alert('Đã hủy cấp quyền đăng ký thành viên!')</script>";
    echo "<script>window.location = '../index.php'</script>";
?>