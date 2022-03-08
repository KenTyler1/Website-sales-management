<?php 
	session_start();
	if(isset($_SESSION['mskh'])){
		unset($_SESSION['mskh']);
	}
	else{
		echo "<script>alert('Bạn chưa có tài khoản vui lòng đăng ký!')</script>";
        echo "<script>window.location = '../homepage/admin/register/register.php'</script>";
	}
	echo "<script>alert('Bạn đã đăng xuất thành công!')</script>";
    echo "<script>window.location = 'index.php'</script>";
?>