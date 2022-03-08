<?php 
	
	require_once("db_connect.php");
	require_once("php/header.php");
	require_once("php/sidebar.php");

?>
<?php 
	if (isset($_GET['ms_hh'])) {
		$ms_hh = $_GET['ms_hh'];
		$query = "SELECT mshh,tenhh,gia,soluonghang,quycach,maloaihang FROM hanghoa WHERE mshh = {$ms_hh} ";                 //'$ms_hh'
		$query_run = mysqli_query($conn, $query);
		if (mysqli_num_rows($query_run) > 0) {
			$prodItem = mysqli_fetch_array($query_run); ?>
  
<div class="container">
	<table>
		
	  <form method="post" action="process.php" enctype="multipart/form-data">	

	  	<input type="hidden" name="ms_hh" value="<?= $prodItem['mshh']; ?>">

		<thead>
			<th colspan="9" style="border-bottom: 2px solid #dddddd; font-size: 50px; color: white; background-color: #22242A;">Update sản phẩm</th>
		</thead>
		<tbody>
			<th colspan="9" style="border-top:none; text-align: left;"><label>Tên sản phẩm: </label><br><input type="text" name="tenhh" style="width: 100%; height: 25px; margin: 5px 0;" value="<?=$prodItem['tenhh']; ?>"></th>
		</tbody>	
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Ảnh sản phẩm: </label><br>
				<?php 
					if (isset($_GET['ms_hh'])) {
						$ms_hh = $_GET['ms_hh'];
						$query_img = "SELECT tenhinh FROM hinhhanghoa WHERE mshh = {$ms_hh} ";
						$result = mysqli_query($conn,$query_img);
						if (mysqli_num_rows($result) > 0) {
							$imgItem = mysqli_fetch_array($result); ?>
				<img src="<?= "image/".$imgItem['tenhinh']; ?>" width='150px' height='120px' alt='Image' style="margin: 10px 5px 0;">
				<input type="file" name="tenhinh" style="margin: 5px 0;">
				<input type="hidden" name="hinh_cu" value="<?= $imgItem['tenhinh']; ?>">
				
			</th>
				  <?php } ?>
			 <?php } ?>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Giá sản phẩm: </label><br><input type="text" name="gia" style="width: 100%; height: 25px; margin: 5px 0;" value="<?= $prodItem['gia']; ?>"></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Số lượng sản phẩm: </label><br><input type="text" name="soluonghang" style="width: 100%; height: 25px; margin: 5px 0;" value='<?=$prodItem['soluonghang']; ?>'></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Quy cách: </label><br><input type="text" name="quycach" style="width: 100%; height: 25px; margin: 5px 0;" value="<?= $prodItem['quycach']; ?>"></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Tên loại hàng: </label><br>
				<?php
					$sql_loai = "SELECT maloaihang,tenloaihang FROM loaihanghoa "; 
					$query_loai = mysqli_query($conn,$sql_loai);
					if(mysqli_num_rows($query_loai) > 0){ ?>
						<select name="maloaihang" required>
							<option value=""><p>Chọn loại hàng hóa</p></option>
						<?php 
							foreach($query_loai as $item){ ?>
								<option value="<?= $item['maloaihang'] ?>" <?= $prodItem['maloaihang'] == $item['maloaihang'] ? 'selected':''; ?>>
									<?= $item['tenloaihang'] ?>		
								</option>
		          	  <?php } ?>
						</select>
			<?php	} ?>
			</th>
		</tbody>
		<thead>
			<th style="border-top: 2px solid #dddddd;"><button name="sbm_update" type="submit" style="width: 200px; font-size:20px;"><i class="fas fa-plus"> Update sản phẩm</i></button></th>
		</thead>
	  </form>
	</table>
	<a href="product.php"><i class="fas fa-arrow-circle-left"> Quay lại</i></a>
</div>
<?php } 
  		else{
  			echo "Không có hàng hóa được tìm thấy";
  		}
	}
?>