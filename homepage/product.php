<?php 
    session_start();
    require_once("php/header.php"); 
    require_once("admin/db_connect.php");


    if (isset($_POST['add'])){
        if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "kh_mshh");
    
        if(in_array($_POST['kh_mshh'], $item_array_id)){
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng..!')</script>";
            echo "<script>window.location = 'category.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'kh_mshh' => $_POST['kh_mshh'],
                'gia' => $_POST['gia'],
                'hh' => $_POST['tenhh'],
                'tenhinh' => $_POST['tenhinh'],
                'soluonghang' => 1
            );

            $_SESSION['cart'][$count] = $item_array;
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng..!')</script>";
            echo "<script>window.location = 'category.php'</script>";
        }

    }else{

        $item_array = array(
                'kh_mshh' => $_POST['kh_mshh'],
                'gia' => $_POST['gia'],
                'hh' => $_POST['tenhh'],
                'tenhinh' => $_POST['tenhinh'],
                'soluonghang' => 1
        );

        $_SESSION['cart'][0] = $item_array;
        }
        echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng..!')</script>";
        echo "<script>window.location = 'category.php'</script>";
    }

    if (isset($_POST['back'])) {
        header('location:category.php');
    }

    if (isset($_GET['ms_hh'])) {
        $ms_hh = $_GET['ms_hh'];
        $query = "SELECT h.mshh,h.tenhh,h.gia,h.soluonghang,h.quycach, img.tenhinh FROM hanghoa h join hinhhanghoa img on h.mshh = img.mshh WHERE h.mshh = {$ms_hh} ";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run); 


    ?>

    <section class="product">
        <div class="container">
            <div class="product-top row">
                <a href="index.php"><p>Trang chủ</p></a> <span>⟶	</span> <p>Điện thoại</p> <span>⟶</span> <p>Hàng mới về</p><span>⟶</span> <p>Samsung Galaxy Z Fold3 5G</p>
            </div>
            <div class="product-content row">
              <form method="post" enctype="multipart/form-data" action="product.php">
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                        <img src="admin/image/<?= $prodItem['tenhinh']; ?>" alt="Image">
                        <input type="hidden" name="tenhinh" value="<?php echo $prodItem['tenhinh']; ?>">
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h1><?= $prodItem['tenhh']; ?></h1>
                        <p>MSP: <?= $prodItem['mshh']; ?></p>
                        <input type="hidden" name="tenhh" value="<?php echo $prodItem['tenhh']; ?>">
                    </div>
                    <div class="product-content-right-product-price">
                        <p><?= number_format($prodItem['gia'], 0, ".", ","); ?><sup>đ</sup></p>
                        <input type="hidden" name="gia" value="<?php echo $prodItem['gia']; ?>">
                    </div>
                    <div class="quantity">
                        <p style="font-weight: bold;">Số lượng:</p>
                        <input type="number" min="0" value="<?= $prodItem['soluonghang']; ?>" style="width: 50px;"> 
                    </div>
                    <div class="product-content-right-product-button">
                        <button type="submit" name="add"><i class="fas fa-shopping-cart"></i><p>GIỎ HÀNG</p></button>
                        <input type='hidden' name='kh_mshh' value='<?= $prodItem['mshh']; ?>'>
                        <button type="submit" name="back"><p>TÌM TẠI CỬA HÀNG</p></button>
                    </div>
                    <div class="product-content-right-product-icon">
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-phone-alt"></i> <p>Hotline</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="far fa-comments"></i> <p>Chat</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="far fa-envelope"></i><p>Mail</p>
                        </div>
                    </div>
                    <div class="product-content-right-product-QR">
                        <img src="admin/image/qrcode2.png" alt="">
                    </div>
                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title row">
                                <div class="product-content-right-bottom-content-title-item chitiet">
                                        <p>Chi tiết</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item cauhinh">
                                        <p>Cấu hình</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item danhgia">
                                    <p>Đánh giá sản phẩm</p>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-danhgia">
                                    <?= $prodItem['quycach']; ?>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
              </form>
            </div>

        </div>

    </section>
<?php } 
        else{
            echo "Không có hàng hóa được tìm thấy";
        }
    }
?>
    <!-- "product-related"------------------- -->
    <section class="product-related container">
        <div class="product-related-title">
            <p>XEM THÊM ĐIỆN THOẠI KHÁC</p>
        </div>
        <div class=" row product-content">
            <?php 
            if (isset($_GET['ms_hh'])) {
                $ms_hh = $_GET['ms_hh'];
                $query_img = "SELECT h.mshh, h.tenhh, img.tenhinh, h.soluonghang, h.gia FROM hanghoa h join hinhhanghoa img on h.mshh = img.mshh WHERE h.mshh <> '$ms_hh'";
                $result = mysqli_query($conn,$query_img);
                if (mysqli_num_rows($result) > 0) {
                    $imgItem = mysqli_fetch_array($result); ?>
            <div class="product-related-item">
                <img src="admin/image/<?= $imgItem['tenhinh']; ?>" alt="Image">
                <h1><?= $imgItem['tenhh']; ?></h1>
                <h2><?= number_format($imgItem['gia'], 0, ".", ","); ?><sup>đ</sup></h2>
            </div>
           <?php } ?>
      <?php } ?>
        </div>
    </section>

<?php require_once("php/footer.php"); ?>