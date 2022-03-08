<?php 
require ('helper.php');
// error variable.
$error = array();

$hotenkh = $_POST['hotenkh'];
if (empty($hotenkh)){
    $error[] = "Bạn đã quên nhập họ tên rồi";
}

$username = validate_input_text($_POST['username']);
if (empty($username)){
    $error[] = "Bạn đã quên nhập tên đăng nhập rồi";
}

$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "Bạn quên nhập mật khẩu rồi";
}

$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if (empty($confirm_pwd)){
    $error[] = "Vui lòng xác nhận lại mật khẩu";
}

$sodienthoai = validate_input_text($_POST['sodienthoai']);
if (empty($sodienthoai)) {
	$error[] = "Bạn quên nhập số điện thoại rồi";
}

$sofax = validate_input_text($_POST['sofax']);
if (empty($sofax)) {
	$error[] = "Bạn quên nhập số fax rồi";
}

$diachi = $_POST['diachi'];
if (empty($diachi)) {
    $error[] = "Bạn quên nhập đia chỉ rồi";
}

$congty = 'TonyK';

if(empty($error)){
    // Đăng ký 1 người dùng mới
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    require ('../db_connect.php');

    // make a query
    $query = "INSERT INTO `khachhang` (`mskh`, `hotenkh`, `username`,`password`,`tencongty`, `sodienthoai`, `sofax` ) VALUES (' ', ?, ?, ?, ?, ?, ?) ";



    // initialize a statement
    $q = mysqli_stmt_init($conn);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'ssssss', $hotenkh, $username, $hashed_pass,$congty, $sodienthoai, $sofax);

    // execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){

        session_start();

        $_SESSION['mskh'] = mysqli_insert_id($conn);
        
        $GET_last_ID = mysqli_insert_id($conn);

        $query_diachi = "INSERT INTO `diachikh` (`madc`,`diachi`,`mskh`) VALUES ('','$diachi','$GET_last_ID')";
        $result_diachi = mysqli_query($conn,$query_diachi);


        header('location: index.php');
        exit();
    }else{
        print "Lỗi trong lúc đăng ký...!";
    }

}else{
    echo 'Không xác thực';
}

