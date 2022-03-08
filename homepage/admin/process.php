<?php 
    require_once('db_connect.php');


    //Update đơn hàng:
    if(isset($_POST['sbm_up'])){
        $sodon_dh = $_POST['sodon_dh'];
        $trangthaidh = $_POST['trangthaidh'];
        $sql_up = "UPDATE `dathang` SET `sodondh` = '$sodon_dh', `trangthaidh` = '$trangthaidh' WHERE sodondh = '$sodon_dh' ";
        $query_up = mysqli_query($conn,$sql_up);

        if ($query_up) {
            echo "<script>alert('Đã update!')</script>";
            echo "<script>window.location = 'theorder.php'</script>";
        }
        else{
            echo "<script>alert('Update không thành!')</script>";
            echo "<script>window.location = 'theorder.php'</script>";
        }
    }



    //Thêm sản phẩm:
    if(isset($_POST['sbm_add'])){
        $tenhh = $_POST['tenhh'];
        $gia = $_POST['gia'];
        $soluonghang = $_POST['soluonghang'];
        $quycach = $_POST['quycach'];
        $maloaihang = $_POST['maloaihang'];
        
        $files = $_FILES['tenhinh'];
        $filename = $files['name'];
        $file_error = $files['error'];
        $file_tmp = $files['tmp_name'];
        $file_ext = explode('.', $filename);

        $file_check = strtolower(end($file_ext));

        $file_ext_stored = array('png','jpg','jpeg');

        $sqli = "INSERT INTO `hanghoa` (`mshh`,`tenhh`, `gia`, `soluonghang`, `quycach`, `maloaihang`) VALUES ('','$tenhh','$gia', '$soluonghang', '$quycach', '$maloaihang')";
        $result = mysqli_query($conn, $sqli);

        $GET_last_ID = mysqli_insert_id($conn);

        if (in_array($file_check,$file_ext_stored)) {
            $destination_file = 'image/'.$filename;
            move_uploaded_file($file_tmp,$destination_file);
            $sql_img = "INSERT INTO `hinhhanghoa`(`mahinh`,`TenHinh`,`mshh`) VALUES ('','$filename','$GET_last_ID')";
            $query = mysqli_query($conn,$sql_img);
            echo "<script>alert('Hàng hóa đã được thêm vào kho hàng..!')</script>";
            echo "<script>window.location = 'product.php'</script>";
        }
    }

    //Update sản phẩm:
    if (isset($_POST['sbm_update'])) {
        $ms_hh = $_POST['ms_hh'];
        $tenhh = $_POST['tenhh'];
        $gia = $_POST['gia'];
        $soluonghang = $_POST['soluonghang'];
        $quycach = $_POST['quycach'];
        $maloaihang = $_POST['maloaihang'];
        
        $tenhinh = $_FILES['tenhinh']['name'];
        $hinh_cu = $_POST['hinh_cu'];

        $sqli = "UPDATE `hanghoa` SET `mshh`='$ms_hh', `tenhh`='$tenhh', `gia`='$gia', `soluonghang`='$soluonghang', `quycach`='$quycach', `maloaihang`='$maloaihang' WHERE mshh = '$ms_hh' ";
        $result = mysqli_query($conn, $sqli);

        if ($tenhinh != '') {
            $update_file_name = $_FILES['tenhinh']['name'];
        }
        else{
            $update_file_name = $hinh_cu;
        }


        if ($_FILES['tenhinh']['name'] != '') 
        {
            if (file_exists("image/".$_FILES['tenhinh']['name'])) {
                echo "<script>alert('Ảnh đã tồn tại..!')</script>";
                echo "<script>window.location = 'product.php'</script>";
            }   
            else
            {
                $query_img = "UPDATE `hinhhanghoa` SET `tenhinh`= '$update_file_name',`mshh`='$ms_hh' WHERE mshh = '$ms_hh'";
                $result_img = mysqli_query($conn,$query_img);
                if ($result_img) 
                {
                    if ($_FILES['tenhinh']['name'] != '') 
                    {
                        move_uploaded_file($_FILES['tenhinh']['tmp_name'],'image/'.$_FILES['tenhinh']['name']);
                        unlink("image/".$hinh_cu);
                    }
                    echo "<script>alert('Hàng hóa đã được update')</script>";
                    echo "<script>window.location = 'product.php' </script>";
                }
                else{
                    echo "<script>alert('Hàng hóa update thất bại')</script>";
                    echo "<script>window.location = 'eidt.php' </script>";
                }
            }
        }
    }

?>