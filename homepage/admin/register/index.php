<?php 
    session_start();
    include "helper.php";

?>
<?php 
    $user = array();    

    require_once("../db_connect.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require ('login-process.php');
    }


    if (isset($_POST['submit'])) {
        $submit = $_POST['submit'];
        if ($submit == 'Đăng ký') {
            header('location:register.php');
        }
    }
?>


<!doctype html>
<html>
    <head>
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,400i|Noto+Sans:400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    </head>
    <body>
        <div class="to">
            <form action="index.php" method="post" enctype="multipart/form-data" id="log-form">
                <div class="form-body" style="padding: 0; margin: 100px 0px 0px 700px;">
                    <h2>Đăng nhập tài khoản</h2>
                    <i class="fas fa-user" style="margin-bottom: 100px;"></i>
                    <label style="margin-left: -210px;">Username: </label>
                    <input type="text" name="username">
                    <label style="margin-left: -215px;">Password: </label>
                    <input type="password" name="password">    
                    <input id="submit" type="submit" name="submit" value="Đăng nhập" >
                    <input id="submit_dk" type="submit" name="submit" value="Đăng ký">
                    <a href="../../index.php" style="margin-right: 290px; margin-top: 145px;"><i class="fas fa-arrow-circle-left">Quay lại</i></a> 
                </div>                 
            </form>
               
        </div>
        <script type="text/javascript" src="main.js"></script>
    </body>
</html>