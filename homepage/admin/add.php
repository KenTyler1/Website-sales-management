<?php 
	
	require_once("db_connect.php");
	require_once("php/header.php");
	require_once("php/sidebar.php");
	$sql_loai = "SELECT maloaihang,tenloaihang FROM loaihanghoa "; 
    $query_loai = mysqli_query($conn,$sql_loai);
	
?>

<div class="container">
	<table>
	  <form method="post" action="process.php" enctype="multipart/form-data">	
		<thead>
			<th colspan="9" style="border-bottom: 2px solid #dddddd; font-size: 50px; color: white; background-color:#22242A;">Thêm sản phẩm</th>
		</thead>
		<tbody>
			<th colspan="9" style="border-top:none; text-align: left;"><label>Tên sản phẩm: </label><br><input type="text" name="tenhh" style="width: 100%; height: 25px; margin: 5px 0;" required></th>
		</tbody>	
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Ảnh sản phẩm: </label><br><input type="file" name="tenhinh" style="margin: 5px 0;"></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Giá sản phẩm: </label><br><input type="text" name="gia" style="width: 100%; height: 25px; margin: 5px 0;" required></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Số lượng sản phẩm: </label><br><input type="text" name="soluonghang" style="width: 100%; height: 25px; margin: 5px 0;" required></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Quy cách: </label><br><input type="text" name="quycach" style="width: 100%; height: 25px; margin: 5px 0;" required></th>
		</tbody>
		<tbody>
			<th colspan="9" style="text-align: left;"><label>Tên loại hàng: </label><br>
				<?php
					if(mysqli_num_rows($query_loai) > 0){ ?>
						<select name="maloaihang">
						<?php 
							foreach($query_loai as $item){ ?>
								<option value="<?= $item['maloaihang'] ?>"><?= $item['tenloaihang'] ?></option>
		          	  <?php } ?>
						</select>
			<?php	} ?>
			</th>
		</tbody>
		<thead>
			<th style="border-top: 2px solid #dddddd;"><button name="sbm_add" type="submit" style="width: 200px; font-size:20px;"><i class="fas fa-plus"> Thêm vào kho</i></button></th>
		</thead>
	  </form>
	</table>
	<a href="product.php"><i class="fas fa-arrow-circle-left"> Quay lại</i></a>
</div>