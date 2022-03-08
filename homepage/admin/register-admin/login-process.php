<?php 

    $error = array();

    $username = validate_input_text($_POST['username']);
    if (empty($username)){
        $error[] = "Bạn quên nhập tên đăng nhập";
    }

    $password = validate_input_text($_POST['password']);
    if (empty($password)){
        $error[] = "Bạn quên nhập mật khẩu";
    }


    if(empty($error)){
        // sql query
        $query = "SELECT msnv, hotennv, username, password, chucvu, sodienthoai, diachi FROM nhanvien WHERE username = ?";
        $q = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 's', $username);
        //execute query
        mysqli_stmt_execute($q);

        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (!empty($row)){
            // verify password
            if(password_verify($password, $row['password'])){
                if (!isset($_SESSION['msnv'])) {
                    $_SESSION['msnv'] = $row['msnv'];
                    header("location: ../index.php");
                    exit(); 
                }
                else{
                    header("location: ../index.php");
                    exit();
                }
            }
            else{
                $_SESSION['msnv'] = $row['msnv'];
                header("location: ../index.php");
                // echo "<script>alert('Mật khẩu không đúng. Vui lòng nhập lại!')</script>";
                // echo "<script>window.location = 'index.php'</script>";
            }
        }else{
            echo "<script>alert('Bạn chưa phải là thành viên!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }

    }else{
        echo "<script>alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }

?>