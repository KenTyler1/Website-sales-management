<?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require ('register-process.php');
    }


    
?>
<!doctype html>
<html>
    <head>
        <title>Đăng kí</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,400i|Noto+Sans:400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    </head>
    <body>
        <div class="to">
            <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                <div class="form-body" style="padding: 0; margin: 100px 0px 0px 700px;">
                    <h2>Đăng ký tài khoản</h2>
                    <i class="fab fa-app-store-ios"></i>

                    <label style="margin-left: -210px;">Họ và tên: </label>
                    <input type="text" name="hotenkh" id="hotenkh" value="<?php if(isset($_POST['hotennv'])) echo $_POST['hotennv']; ?>" placeholder="Họ và tên">

                    <label style="margin-left: -200px;">Username: </label>
                    <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" placeholder="Tên đăng nhập">

                    <label style="margin-left: -210px">Password: </label>
                    <input type="password" name="password" id="password" placeholder="Mật khẩu">

                    <label style="margin-left: -150px">Confirm-password: </label>
                    <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Xác nhận mật khẩu" > 
                    <small id="confirm_error"></small>

                    <label style="margin-left: -190px;">Số điện thoại: </label>
                    <input type="text" name="sodienthoai" value="<?php if(isset($_POST['sodienthoai'])) echo $_POST['sodienthoai']; ?>" placeholder="Số điện thoại">   

                    <label style="margin-left: -230px;">Chức vụ: </label>
                    <input type="text" name="chucvu" value="<?php if(isset($_POST['chucvu'])) echo $_POST['chucvu']; ?>" placeholder="Số fax">

                    <label style="margin-left: -230px;">Địa Chỉ: </label>
                    <input type="text" name="diachi" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']; ?>" placeholder="Địa chỉ">

                    <input id="submit" type="submit" name="submit" value="Đăng ký" style="margin-top:10px;">
                    <a href="index.php" style="margin-right: 290px; margin-top: 7px;"><i class="fas fa-arrow-circle-left">Quay lại</i></a> 
                </div>                 
            </form>

                          
        </div>
        <script type="text/javascript" src="main.js"></script>
    </body>
</html>