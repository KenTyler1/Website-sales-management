<?php

    session_start();

    require_once("php/header.php"); 
    require_once("admin/db_connect.php");
    include ('../homepage/admin/register/helper.php');

    $user = array();

    if(isset($_SESSION['mskh'])){
        $user = get_user_info($conn, $_SESSION['mskh']);
    }


    $sql_nv = "SELECT msnv FROM nhanvien";
    $result_nv = mysqli_query($conn,$sql_nv);   

    // $cart = !empty($_SESSION['cart']) ? $_SESSION['cart']:[];
    // print_r($cart);

    // if (isset($user['mskh'])) {
    //     print_r($user['mskh']);
    // }
    // if (isset($_SESSION['msnv'])) {
    //     print_r($_SESSION['msnv']);
    // }


    if (isset($_POST['submit']) ) {
        $hotenkh = $_POST['hotenkh'];
        $tencongty = $_POST['tencongty'];
        $sodienthoai = $_POST['sodienthoai'];
        $sofax = $_POST['sofax'];
        $diachi = $_POST['diachi'];
        $now = date_create('now')->format('Y-m-d H:i:s');
        $date = date("Y.m.d H:i:s",strtotime($now."+7 day"));
        $total = 0;
        $SL = 0;
        if (isset($_POST['loaikhach'])) {
            $loaikhach = $_POST['loaikhach'];

            //Dành cho khách lẻ không có hoặc không cần tài khoản
            if ($loaikhach == 'khachle') {
                if (isset($_SESSION['mskh'])) {
                    echo "<script>alert('Bạn đã đăng nhập tài khoản. Vui lòng chọn đăng ký để tiếp tục!')</script>";
                    echo "<script>window.location = 'delivery.php'</script>";
                }
                if ($hotenkh != '' && $sodienthoai != '' && $sofax != '' && $diachi != '' && !isset($_SESSION['mskh'])) {
                    $sql_kh = "INSERT INTO `khachhang` (`mskh`, `hotenkh`,`username`,`password`, `tencongty` , `sodienthoai`, `sofax`) VALUES ('','$hotenkh','khách lẻ','','$tencongty','$sodienthoai','$sofax') ";
                    $result_kh = mysqli_query($conn,$sql_kh);

                    $_SESSION['mskh'] = mysqli_insert_id($conn);
                    $mskh_ss = mysqli_insert_id($conn);

                    $sql_dc = "INSERT INTO `diachikh`(`madc`,`diachi`,`mskh`) VALUES ('','$diachi','$mskh_ss')";
                    $result_dc = mysqli_query($conn,$sql_dc);
                    if ($result_kh && $result_dc) {
                        if (mysqli_num_rows($result_nv) > 0) {
                            $row = mysqli_fetch_assoc($result_nv);
                            $msnv = $row['msnv'];

                            $sql_dh = "INSERT INTO `dathang` (`sodondh`,`mskh`,`msnv`,`ngaydh`,`ngaygh`) VALUES (' ','$mskh_ss','$msnv','$now','$date')";
                            $result_dh = mysqli_query($conn,$sql_dh);
                            $_SESSION['sodondh'] =  mysqli_insert_id($conn); 
                            $sodondh_ss = mysqli_insert_id($conn);
                            if ($result_dh) {
                                if (isset($_SESSION['cart'])) {
                                    $query = "INSERT INTO `chitietdathang` (`sodondh`,`mshh`,`soluong`,`giadathang`,`giamgia`) VALUES (?,?,?,?,?)";
                                    $stmt = mysqli_prepare($conn,$query);
                                    if ($stmt) {
                                        mysqli_stmt_bind_param($stmt,"iiiii",$sodondh_ss,$mshh,$soluong,$giadathang,$sales);
                                        foreach($_SESSION['cart'] as $key => $value){
                                            $total = 0;
                                            $mshh = $value['kh_mshh'];
                                            $soluong = $value['soluonghang'];
                                            $total += $soluong * $value['gia'];
                                            $giadathang = $total;
                                            if ($total < 5000000 ) {
                                                $discount = 3; //Giảm 3% cho sản phẩm dưới 5tr  
                                            }
                                            if ($total > 5000000 && $total < 10000000 ) {
                                                $discount = 5; //Giảm 5% cho sản phẩm trên 5tr và dưới 10tr
                                            }
                                            if ($total > 10000000 && $total < 20000000 ) {
                                                $discount = 7; //Giảm 7% cho sản phẩm trên 10tr và dưới 20tr 
                                            }
                                            if ($total > 20000000 && $total < 40000000 ) {
                                                $discount = 10; //Giảm 10% cho sản phẩm trên 20tr và dưới 40tr
                                            }
                                            if ($total > 40000000 && $total < 60000000) {
                                                $discount = 20; //Giảm 20% cho sản phẩm trên 40tr và dưới 60tr
                                            }
                                            if ($total > 60000000) {
                                                $discount = 30; //Giảm 30% cho sản phẩm trên 60tr
                                            }
                                            $sales = $discount;
                                            mysqli_stmt_execute($stmt);


                                            $query_hh = "SELECT soluonghang FROM hanghoa WHERE mshh = '$mshh' ";
                                            $result_hh = mysqli_query($conn,$query_hh);
                                            if ($result_hh) {
                                                while ($row = mysqli_fetch_assoc($result_hh)) {
                                                    $SL = 0;
                                                    $soluonghanghoa = $row['soluonghang'];
                                                    $SL += $soluonghanghoa - $soluong;
                                                    $query_up = "UPDATE `hanghoa` SET `soluonghang` = '$SL' WHERE mshh = '$mshh' ";
                                                    $result = mysqli_query($conn,$query_up);
                                                }
                                            }
                                            else{
                                                echo "<script>alert('SQL lỗi rồi')</script>";
                                                echo "<script>window.location = 'delivery.php'</script>";
                                            }
                                            
                                        }
                                    }
                                    else{
                                        echo "<script>alert('Lỗi!')</script>";
                                        echo "<script>window.location = 'delivery.php'</script>";
                                    }
                                    
                                    unset($_SESSION['cart']);
                                    echo "<script>alert('Sản phẩm đã được mua!')</script>";
                                    echo "<script>window.location = 'index.php'</script>";
                                }
                                else{
                                    echo "<script>alert('SQL lỗi')</script>";
                                    echo "<script>window.location = 'delivery.php'</script>";
                                }
                            }
                            else {
                                echo "<script>alert('Vui lòng điền đẩy đủ thông tin')</script>";
                                echo "<script>window.location = 'delivery.php'</script>";
                            }
                        }
                        else {
                            echo "<script>alert('Chưa có nhân viên')</script>";
                            echo "<script>window.location = 'delivery.php'</script>";
                        }
                    }
                    else{
                        echo "<script>alert('Vui lòng điền đẩy đủ thông tin')</script>";
                        echo "<script>window.location = 'delivery.php'</script>";
                    }

                }     
            }

            if ($loaikhach == 'dangky') {
                if (isset($_SESSION['mskh'])) {
                    $mskh = $_SESSION['mskh'];
                    $sql = "SELECT mskh FROM khachhang WHERE mskh ='$mskh'";
                    $query_kh = mysqli_query($conn,$sql);
                    if ($query_kh) {
                        if (mysqli_num_rows($result_nv) > 0) {
                            $row = mysqli_fetch_assoc($result_nv);
                            $msnv = $row['msnv'];

                            $sql_dh = "INSERT INTO `dathang` (`sodondh`,`mskh`,`msnv`,`ngaydh`,`ngaygh`) VALUES (' ','$mskh','$msnv','$now','$date')";
                            $result_dh = mysqli_query($conn,$sql_dh);
                            $_SESSION['sodondh'] =  mysqli_insert_id($conn); 
                            $sodondh_ss = mysqli_insert_id($conn);   

                            if ($result_dh) {
                                if (isset($_SESSION['cart'])) {
                                    $query = "INSERT INTO `chitietdathang` (`sodondh`,`mshh`,`soluong`,`giadathang`,`giamgia`) VALUES (?,?,?,?,?)";
                                    $stmt = mysqli_prepare($conn,$query);
                                    if ($stmt) {
                                        mysqli_stmt_bind_param($stmt,"iiiii",$sodondh_ss,$mshh,$soluong,$giadathang,$sales);
                                        foreach($_SESSION['cart'] as $key => $value){
                                            $total = 0;
                                            $mshh = $value['kh_mshh'];
                                            $soluong = $value['soluonghang'];
                                            $total += $soluong * $value['gia'];
                                            $giadathang = $total;
                                            if ($total < 5000000 ) {
                                                $discount = 3; //Giảm 3% cho sản phẩm dưới 5tr  
                                            }
                                            if ($total > 5000000 && $total < 10000000 ) {
                                                $discount = 5; //Giảm 5% cho sản phẩm trên 5tr và dưới 10tr
                                            }
                                            if ($total > 10000000 && $total < 20000000 ) {
                                                $discount = 7; //Giảm 7% cho sản phẩm trên 10tr và dưới 20tr 
                                            }
                                            if ($total > 20000000 && $total < 40000000 ) {
                                                $discount = 10; //Giảm 10% cho sản phẩm trên 20tr và dưới 40tr
                                            }
                                            if ($total > 40000000 && $total < 60000000) {
                                                $discount = 20; //Giảm 20% cho sản phẩm trên 40tr và dưới 60tr
                                            }
                                            if ($total > 60000000) {
                                                $discount = 30; //Giảm 30% cho sản phẩm trên 60tr
                                            }
                                            $sales = $discount;
                                            mysqli_stmt_execute($stmt);

                                            $query_hh = "SELECT soluonghang FROM hanghoa WHERE mshh = '$mshh' ";
                                            $result_hh = mysqli_query($conn,$query_hh);
                                            if ($result_hh) {
                                                while ($row = mysqli_fetch_assoc($result_hh)) {
                                                    $SL = 0;
                                                    $soluonghanghoa = $row['soluonghang'];
                                                    $SL += $soluonghanghoa - $soluong;
                                                    $query_up = "UPDATE `hanghoa` SET `soluonghang` = '$SL' WHERE mshh = '$mshh' ";
                                                    $result = mysqli_query($conn,$query_up);
                                                }
                                            }
                                            else{
                                                echo "<script>alert('SQL lỗi rồi')</script>";
                                                echo "<script>window.location = 'delivery.php'</script>";
                                            }
                                            
                                        }
                                    }
                                    else{
                                        echo "<script>alert('SQL lỗi')</script>";
                                        echo "<script>window.location = 'delivery.php'</script>";
                                    }
                                    unset($_SESSION['cart']);
                                    echo "<script>alert('Sản phẩm đã được mua!')</script>";
                                    echo "<script>window.location = 'index.php'</script>";
                                }
                                else{
                                    echo "<script>alert('SQL lỗi')</script>";
                                    echo "<script>window.location = 'delivery.php'</script>";
                                }
                            }
                            else{
                                echo "<script>alert('Lỗi sql!')</script>";
                                echo "<script>window.location = 'delivery.php'</script>";
                            }
                        }
                        else{
                            echo "<script>alert('Chưa có nhân viên!')</script>";
                            echo "<script>window.location = 'delivery.php'</script>";
                        }

                    }
                    else{
                        echo "<script>alert('SQL lỗi')</script>";
                        echo "<script>window.location = 'delivery.php'</script>";
                    }
                }
                else{
                    echo "<script>alert('Vui lòng đăng ký để tiếp tục!')</script>";
                    echo "<script>window.location = '../homepage/admin/register/register.php'</script>";
                }
            }
        }
    }
            

?>

 <section class="delivery">
     <div class="container">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-delivery delivery-top-item">
                   <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="delivery-top-adress delivery-top-item">
                   <i class="fas fa-map-marker-alt "></i>
                </div>
                <div class="delivery-top-payment delivery-top-item">
                   <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
         </div>
     </div>
     <div class="container">
         <div class="delivery-content row">
            <div class="delivery-content-left">
              <form action="delivery.php" method="post" enctype="multipart/form-data">
                <p>Vui lòng chọn địa chỉ giao hàng</p>
                <div class="delivery-content-left-dangnhap row">
                    <i class="fas fa-sign-in-alt"></i>
                    <p><a href="../homepage/admin/register/index.php" style="color: black;">Đăng nhập </a>(Nếu bạn đã có tài khoản của Tony.K)</p>
                </div>
                <div class="delivery-content-left-khachle row">
                    <input checked name="loaikhach" value="khachle" type="radio">
                    <p><span style="font-weight: bold;">Khách lẻ</span> (Nếu bạn không muốn lưu lại thông tin)</p>
                </div>
                <div class="delivery-content-left-dangky row">
                    <input name="loaikhach" value="dangky" type="radio" >
                    <p><span style="font-weight: bold; color: black;">Đăng ký</span> (Tạo mới tài khoản với thông tin bên dưới) </p>
                    <p style="color:red;"><?php echo isset($user['hotenkh']) ? $user['hotenkh'] : ''; ?></p>
                </div>
                <div class="delivery-content-left-input-top row">
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Họ tên<span style="color: red;">*</span></label>
                        <input type="text" name="hotenkh">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Điện thoại <span style="color: red;">*</span></label>
                        <input type="text" name="sodienthoai">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="">Số Fax <span style="color: red;">*</span></label>
                        <input type="text" name="sofax">
                    </div>
                    <div class="delivery-content-left-input-top-item">
                        <label for="" placeholder="Nếu có">Tên Công Ty <span style="color: red;">*</span></label>
                        <input type="text" name="tencongty">
                    </div>                   
                </div>
                <div class="delivery-content-left-input-bottom">
                    <label for="">Địa chỉ <span style="color: red;">*</span></label>
                    <input type="text" name="diachi">
                </div>
              <div class="delivery-content-left-button row">
                <a href="cart.php"><span>«</span><p>Quay lại giỏ hàng</p></a>
                <button type="submit" name="submit"><p style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</p></button></a>
              </div>
              </form>
            </div>                
            
            <div class="delivery-content-right">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th colspan="2">Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                <?php
                    if (isset($_SESSION['cart'])){
                        foreach ($_SESSION['cart'] as $key => $value){ 
                            $masohh = $value['kh_mshh'];
                    ?>
                            <tr>
                                <td><?php echo $value['hh']; ?></td>
                                <td colspan="2">
                                    <form method="post" action="delivery.php">
                                        <input type="text" class="quantity" name="Mod_quantity" onChange="this.form.submit();" value="<?php echo $value['soluonghang'];  ?>" min="1" max="100" style="margin-left: 55px;">
                                        <input type="hidden" name="tenhh" value="<?php $value['hh']; ?>">
                                    </form>
                                </td>
                                <input type="hidden" class="igia" value="<?php echo $value['gia']; ?>">
                                <td>
                                    <p class="total"></p>
                                </td>
                                
                <?php   } ?>
            <?php   }
                    else{
                        echo "<script>alert('Giỏ hàng trống trơn!')</script>";
                        echo "<script>window.location = 'category.php'</script>";
                    }   
                    ?>             
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Số lượng đơn hàng</td>
                        <td style="font-weight: bold;"><p><?php  
                                if (isset($_SESSION['cart'])){
                                    $count  = count($_SESSION['cart']);
                                    echo "<h4> $count </h3>";
                                }else{
                                    echo "<h4> 0 </h3>";
                                }
                            ?></p></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;" colspan="3">Tổng</td>
                        <td style="font-weight: bold;" id="itotal"><p></p></td>
                    </tr>
                   <tr>
                       <td style="font-weight: bold;" colspan="3">Tổng tiền hàng</td>
                       <td style="font-weight: bold;" id="gtotal"></p></td>
                   </tr>
                </table>
           </div>
         </div>
       
     </div>
 </section>
<script>
    var gt = 0;
    var gia = document.getElementsByClassName('igia');
    var quantity = document.getElementsByClassName('quantity');
    var total = document.getElementsByClassName('total');
    var itotal = document.getElementById('itotal');
    var gtotal = document.getElementById('gtotal');
    var xx = '';


    function subTotal() {
        gt = 0;
        for(i=0;i<gia.length;i++){ 
            xx = (gia[i].value)*(quantity[i].value)
            total[i].innerText = xx.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + ' đ';
            gt = gt + (gia[i].value)*(quantity[i].value);
        }
        itotal.innerText = gt.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + ' đ';
        gtotal.innerText = gt.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + ' đ';
    }

    subTotal();

</script>
<?php require_once("php/footer.php"); ?>