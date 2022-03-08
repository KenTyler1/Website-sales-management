<?php 

    session_start();

    require_once("admin/db_connect.php");
    // require_once("php/component.php");

    if (isset($_GET['search']) && !empty($_GET['search'])) {
		$key = $_GET['search'];
		$sql =  "SELECT h.mshh, h.tenhh, h.gia, h.soluonghang, img.tenhinh l.tenloaihang FROM hanghoa h join loaihanghoa l on h.mshh = l.mshh join hinhhanghoa img on h.mshh = img.mshh WHERE h.mshh LIKE '%$key%' OR h.tenhh LIKE '%$key%' OR l.tenloaihang LIKE '%$key%'";
	}
	$result = mysqli_query($conn,$sql);
    

    if (isset($_POST['add'])){
        if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "kh_mshh");
    
        if(in_array($_POST['kh_mshh'], $item_array_id)){
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng..!')</script>";
            echo "<script>window.location = 'product.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'kh_mshh' => $_POST['kh_mshh']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'kh_mshh' => $_POST['kh_mshh']
        );

        $_SESSION['cart'][0] = $item_array;
        }
    }


?>

<?php require_once("php/header.php"); ?>

    <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row">
                <p>Trang chủ</p> <span>⟶	</span> <p>Điện thoại</p> <span>⟶</span> <p>Hàng mới về</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="cartegory-left">
                    <ul>
                        <li class="cartegory-left-li "><a href="#">Điện thoại</a>
                            <ul>
                                <li><a href="">HÀNG MỚI VỀ</a></li>
                                <li><a href="">Iphone</a></li>
                                <li><a href="">SamSung</a></li>
                                <li><a href="">Xiaomi</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">Laptop</a>
                            <ul>
                                <li><a href="">HÀNG MỚI VỀ</a></li>
                                <li><a href="">Apple</a></li>
                                <li><a href="">Dell</a></li>
                                <li><a href="">Asus</a></li>
                                <li><a href="">Lenovo</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="">ĐỒNG HỒ</a></li>
                        <li class="cartegory-left-li"><a href="">BỘ SƯU TẬP</a></li>
                        <li class="cartegory-left-li"><a href="">SIM/THẺ CÀO</a></li>
                    </ul>

                </div>
                <div class="cartegory-right row">
                    <div class="cartegory-right-top-item">
                        <p>HÀNG MỚI VỀ</p>
                    </div>
                    <div class="cartegory-right-top-item">
                       <button><span>Bộ lọc</span> <i class="fas fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Giá cao đến thấp</option>
                            <option value="">Giá thấp đến cao</option>
                        </select>
                    </div>
                    <div class="cartegory-right-content row">
                        <?php 
                            // component("Samsung Galaxy Z Fold3 5G", "43990000","./image/sp1.1.jpg");
                            // component("Iphone 12 64GB","20490000","./image/sp2.jpg");
                            // component("Xiaomi 11 Lite 5G NE","9490000","./image/sp3.jpg");
                            // component("Galaxy A52 8GB/128GB","8790000","./image/sp4.jpg");
                            // component("OPPO Reno6 Z 5G","9490000","./image/sp5.jpg");
                            // component("Samsung Galaxy S20 FE","12990000","./image/sp6.jpg");
                            // component("OPPO A74","6690000","./image/sp7.jpg");
                            // component("Realme C21Y 4GB","3990000","./image/sp8.jpg");

                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="cartegory-right-content-item">
                                    <form action="category.php" method="post">
                                        <a href="product.php?ms_hh=<?php echo $row['mshh']; ?>"><img src="./admin/image/<?php echo $row['tenhinh']; ?>" alt="Image"></a>
                                        <h1><?php echo $row['tenhh']; ?></h1>
                                        <label>Số lượng: <?php echo $row['soluonghang']; ?></label>
                                        <p><?php echo number_format($row['gia'], 0, ".", ",");?><sup>đ</sup></p>
                                        <button type="submit" name="add">Thêm vào giỏ hàng <i class="fas fa-shopping-cart"></i></button>
                                        <input type='hidden' name='kh_mshh' value='<?php echo $row['mshh']; ?>'>
                                    </form>
                                </div>
                            <?php } ?>
                    </div>
                   <div class="cartegory-right-bottom row">
                       <div class="cartegory-right-bottom-items">
                           <p>Hiện thị 2 <span>|</span> 4 sản phẩm</p>
                       </div>
                       <div class="cartegory-right-bottom-items">
                        <p><span>«</span>1 2 3 4 5<span>»</span>Trang cuối</p>
                        </div>
                   </div> 
                </div>
                
            </div>
        </div>
    </section>

     
<?php require_once('php/footer.php') ?>