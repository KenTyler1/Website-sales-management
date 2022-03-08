<?php 
	require_once("db_connect.php");
	require_once("php/header.php");
	require_once("php/sidebar.php");
     
?>
<?php 
	if (isset($_GET['sodon_dh'])) {
		$sodon_dh = $_GET['sodon_dh'];
		$query = "SELECT sodondh, mskh, msnv,ngaydh,ngaygh,trangthaidh FROM dathang WHERE sodondh = {$sodon_dh} ";                 //'$ms_hh'
		$query_run = mysqli_query($conn, $query);
		if (mysqli_num_rows($query_run) > 0) {
			$prodItem = mysqli_fetch_array($query_run); ?>
<div class="container">
	<table>
	  <form method="post" enctype="multipart/form-data" action="process.php">
	  	<input type="hidden" name="sodon_dh" value="<?= $prodItem['sodondh']; ?>">
		<thead>
			<th colspan="10" style="border-bottom: 2px solid #dddddd; font-size: 50px; color: white; background-color: #22242A;">Đơn hàng đã đặt hàng</th>
		</thead>
		<thead>
			<th>Mã số ĐH</th>
			<th>Mã KH</th>
			<th>Mã số NV</th>
			<th>Ngày ĐH</th>
			<th>Ngày GH</th>
			<th>Status</th>
		</thead>	
		<tbody>
			<th><?php echo $prodItem['sodondh']; ?></th>
			<th><?php echo $prodItem['mskh']; ?></th>
			<th><?php echo $prodItem['msnv']; ?></th>
			<th><?php echo $prodItem['ngaydh']; ?></th>	
			<th><?php echo $prodItem['ngaygh']; ?></th>
			<th>
				<select name="trangthaidh">
					<option value="0" <?php if($prodItem['trangthaidh'] == 0) echo "selected";?>>Chưa xử lí</option>
					<option value="1" <?php if($prodItem['trangthaidh'] == 1) echo "selected";?> >Đang xử lí đơn hàng</option>
					<option value="2" <?php if($prodItem['trangthaidh'] == 2) echo "selected";?>>Đang giao hàng</option>
					<option value="3" <?php if($prodItem['trangthaidh'] == 3) echo "selected";?>>Đơn hàng giao thành công</option>
				</select>
			</th>
		</tbody>
		<thead>
			<th style="border-top: 2px solid #dddddd;" colspan="6"><button name="sbm_up" type="submit" style="width: 200px; font-size:20px;"><i class="fas fa-plus"> Update đơn hàng</i></button></th>
		</thead>	
  	  </form>
	</table>
</div>
<?php } 
  		else{
  			echo "Không có đơn hàng được tìm thấy";
  		}
	}
?>