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

$chucvu = $_POST['chucvu'];
if (empty($chucvu)) {
	$error[] = "Bạn quên nhập chức vụ rồi";
}

$diachi = $_POST['diachi'];
if (empty($diachi)) {
    $error[] = "Bạn quên nhập đia chỉ rồi";
}

//Tham khảo:

if(empty($error)){
    // Đăng ký 1 người dùng mới
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    require ('../db_connect.php');

    // make a query
    $query = "INSERT INTO `nhanvien` (`msnv`, `hotennv`, `username`,`password`,`chucvu`, `diachi`, `sodienthoai` ) VALUES (' ', ?, ?, ?, ?, ?, ?) ";



    // initialize a statement
    $q = mysqli_stmt_init($conn);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'ssssss', $hotenkh, $username, $hashed_pass, $chucvu, $diachi, $sodienthoai);

    // execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){

        session_start();

        $_SESSION['msnv'] = mysqli_insert_id($conn);
        

        header('location: index.php');
        exit();
    }else{
        print "Lỗi trong lúc đăng ký...!";
    }

}else{
    echo 'Không xác thực';
}

