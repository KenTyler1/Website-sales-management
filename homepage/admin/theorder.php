<?php 
	require_once("db_connect.php");
	require_once("php/header.php");
	require_once("php/sidebar.php");
	$sql = "SELECT sodondh, mskh, msnv,ngaydh,ngaygh,trangthaidh FROM dathang ";
    $query = mysqli_query($conn,$sql);

     
?>


<div class="container">
	<table>
	  <form method="post" enctype="multipart/form-data" action="process.php">
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
			<th>Change</th>
		</thead>	
		<?php 
		if ($query) {
			while($result = mysqli_fetch_array($query)) { ?>
				<tbody>
					<th><?php echo $result['sodondh']; ?></th>
					<th><?php echo $result['mskh']; ?></th>
					<th><?php echo $result['msnv']; ?></th>
					<th><?php echo $result['ngaydh']; ?></th>	
					<th><?php echo $result['ngaygh']; ?></th>
					<th><?php  if($result['trangthaidh'] == 0){
							    	echo "Chưa xử lí";
							   }elseif ($result['trangthaidh'] == 1) {
							   		echo "Đang xử lí";
							   }
							   elseif($result['trangthaidh'] == 2){
							   		echo "Đang giao hàng";
							   }
							   elseif($result['trangthaidh'] == 3){
							   		echo "Giao hàng thành công";
							   } 
					?>	
					</th>
					<th><a href="status.php?sodon_dh=<?php echo $result['sodondh']; ?>"><i class="fas fa-plus">Update</i></a></th>
				</tbody>	
  	  <?php } ?>
 <?php } else{
 			echo "Không ổn";
 		} ?>
  		</form>
	</table>
</div>