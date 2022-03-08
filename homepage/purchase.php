<?php
	session_start();
	require_once("php/header.php"); 
    require_once("admin/db_connect.php");

    
 
?>


<section class="purchase">
	<div class="container">
		<table class="purchase-top row">
				<tr>
					<th colspan="8"><h1 style="font-size: 30px; border-bottom: 2px solid #ddd; padding: 10px 0;">Lịch sử mua hàng</h1></th>
				</tr>
				<tr>
					<th>Tên</th>
					<th>Tên sản phẩm</th>
					<th>Sản phẩm</th>
					<th>SL</th>
					<th>Ngày đặt hàng</th>
					<th>Ngày giao hàng</th>
					<th>Trạng thái</th>
					<th>Hủy đơn</th>
				</tr>
				<?php
				if (isset($_SESSION['mskh'])) {
			    	$mskh = $_SESSION['mskh'];
			    	$query = "SELECT dt.mskh, dt.sodondh,ct.soluong, dt.ngaydh, dt.ngaygh, h.tenhh, dt.trangthaidh, kh.hotenkh, img.tenhinh, ct.mshh FROM dathang dt join chitietdathang ct on dt.sodondh = ct.sodondh join hanghoa h on ct.mshh = h.mshh join khachhang kh on kh.mskh = dt.mskh join hinhhanghoa img on h.mshh = img.mshh WHERE kh.mskh = '$mskh' AND dt.sodondh = ct.sodondh";
			    	$result = mysqli_query($conn,$query);
			    	if ($result) {
			    		while ($row = mysqli_fetch_assoc($result)) {
			    ?>
				<tr>
					<td><?php echo $row['hotenkh']; ?></td>
					<td><img src="./admin/image/<?php echo $row['tenhinh']; ?>" width="180px"></td>
					<td><?php echo $row['tenhh']; ?></td>
					<td><?php echo $row['soluong']; ?></td>
					<td><?php echo $row['ngaydh']; ?></td>
					<td><?php echo $row['ngaygh']; ?></td>
					<td>
						<?php
							if ($row['trangthaidh'] == 0) {
								echo "Chưa xử lí";
							}
							if ($row['trangthaidh'] == 1) {
								echo "Đang xử lí đơn hàng";
							}
							if ($row['trangthaidh'] == 2) {
								echo "Đang giao hàng";
							}
							if ($row['trangthaidh'] == 3) {
								echo "Giao thành công";
							}
						?>
					</td>
					<td><a href="php/delete.php?ms_hh=<?php echo $row['mshh'];?>"><i class="fas fa-trash-alt"> Hủy</i></a></td>
				</tr>	 
					<?php } ?>
			  <?php } ?>
		  <?php } 
		  		else{
		  			echo "<script>alert('Đơn hàng trống trơn!')</script>";
        			echo "<script>window.location = 'index.php'</script>";
		  		}
		  		?>
			
		</table>
	</div>
</section>

<?php require_once("php/footer.php"); ?>