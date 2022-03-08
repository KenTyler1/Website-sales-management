<?php
    session_start();
    
    include ('../homepage/admin/register/helper.php');
    require_once("php/header.php"); 
    require_once("admin/db_connect.php");

    $user = array();


    if(isset($_SESSION['mskh'])){
        $user = get_user_info($conn, $_SESSION['mskh']);
    }

    if (isset($_POST['remove'])){
        if ($_GET['action'] == 'remove'){
            foreach ($_SESSION['cart'] as $key => $value){
                if($value["kh_mshh"] == $_GET['mshh']){
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    echo "<script>alert('Sản phẩm đã được xóa...!')</script>";
                    echo "<script>window.location = 'cart.php'</script>";
                }
            }
        }
    }   

    if (isset($_POST['back'])) {
        header('location:category.php');
    }
    elseif(isset($_POST['payment'])){
        header('location:delivery.php');
    }

    if (isset($_POST['Mod_quantity'])) {
        foreach($_SESSION['cart'] as $key => $value){
            if($value["hh"] == $_POST['tenhh']){
                $_SESSION['cart'][$key]['soluonghang'] = $_POST['Mod_quantity'];
                // print_r($_SESSION['cart']);
            }
        }   
    }


?>
 <section class="cart">
     <div class="container">
         <div class="cart-top-wrap">
            <div class="cart-top">
                <div class="cart-top-cart cart-top-item">
                   <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="cart-top-adress cart-top-item">
                   <i class="fas fa-map-marker-alt "></i>
                </div>
                <div class="cart-top-payment cart-top-item">
                   <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
         </div>
     </div>
     <div class="container">
         <div class="cart-content row">
             <div class="cart-content-left">
                <table>
                    <tr>
                        <th>Mã số</th>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
                    $s = 0;
                    if (isset($_SESSION['cart'])){
                        foreach ($_SESSION['cart'] as $key => $value){ 
                            $masohh = $value['kh_mshh'];
                    ?>
                    <tr> 
                        <td><?php echo $masohh; ?></td>
                        <td><img src="./admin/image/<?php echo $value['tenhinh']; ?>" width="200px" height="160px" alt="Image"></td>
                        <td><p><?php echo $value['hh']; ?></p></td>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="number" class="quantity" name="Mod_quantity" onChange="this.form.submit();" value="<?php echo $value['soluonghang'];  ?>" min="1" max="100" style="margin-left: 55px;">    
                                <input type="hidden" name="tenhh" value="<?php echo $value['hh']; ?>">
                            </form>
                        </td>   
                        <input type="hidden" class="igia" value="<?php echo $value['gia']; ?>">
                        <td class="total">
                        </td>
                        <form action="cart.php?action=remove&mshh=<?php echo $masohh; ?>" method="post">
                            <td><button type="submit" name="remove">Xóa</button></td>
                        </form>       
                    </tr> 
                                    
                 <?php  } ?>
        <?php   }  else{
                        echo "<script>alert('Giỏ hàng trống trơn!')</script>";
                        echo "<script>window.location = 'category.php'</script>";
                }
            ?>

                </table>
             </div>
             <div class="cart-content-right">
                 <table>
                     <tr>
                         <th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
                     </tr>
                     <tr>
                         <td>TỔNG ĐƠN HÀNG</td>
                         <td>                        
                            <?php
                                if (isset($_SESSION['cart'])){
                                    $count  = count($_SESSION['cart']);
                                    echo "<h3> $count đơn hàng</h3>";
                                }else{
                                    echo "<h3> 0 đơn hàng</h3>";
                                }
                            ?>
                            
                        </td>
                     </tr>
                     <tr>
                         <td>TỔNG TIỀN HÀNG</td>
                         <td><p id="itotal"></p></td>
                     </tr>
                     <tr>
                         <td>TẠM TÍNH</td>
                         <td><p style="color: black; font-weight: bold;" id="gtotal"></p></td>
                     </tr>
                 </table>
                 <div class="cart-content-right-text">
                     <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có tổng giá trị trên 10.000.000 đ</p>
                     <p style="color: red; font-weight: bold;">Mua thêm <span style="font-size: 18px;">10.000.000đ</span> để được miễn phí SHIP</p>
                 </div>
                 <div class="cart-content-right-button">
                    <form method="post" action="cart.php">
                        <button type="submit" name="back">TIẾP TỤC MUA SẮM</button>
                        <button type="submit" name="payment">THANH TOÁN</button> 
                    </form>
                     
                 </div>
                 <div class="cart-content-right-dangnhap">
                     <p>TÀI KHOẢN TONY.K: <?php echo isset($user['hotenkh']) ? $user['hotenkh'] : ''; ?> </p><br>
                     <p>Hãy <a href="../homepage/admin/register/index.php">Đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
                    
                 </div>
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