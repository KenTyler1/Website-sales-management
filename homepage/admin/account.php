<?php 
	require_once('db_connect.php');
	require_once('php/header.php');
	require_once('php/sidebar.php');

	$sql = "SELECT kh.mskh, kh.hotenkh, kh.username, kh.password, kh.tencongty, kh.sodienthoai, kh.sofax, dc.diachi FROM khachhang kh join diachikh dc on kh.mskh = dc.mskh ";
	$query = mysqli_query($conn, $sql);


?>
<div class="container">
	<table>
		<thead>
			<th colspan="10" style="border-bottom: 2px solid #dddddd; font-size: 50px; color: white; background-color: #22242A;">Quản lý khách hàng</th>
		</thead>
		<thead>
			<th style="width: 70px">Mã số </th>
			<th style="width: 150px;">Họ tên</th>
			<th>Username</th>
			<th>Password</th>
			<th style="width: 90px;">Tên công ty</th>
			<th>Số điện thoại</th>
			<th>Số Fax</th>
			<th style="width:150px">Địa chỉ</th>
		</thead>	
		<?php 
		if ($query) {
			while($result = mysqli_fetch_array($query)) { ?>
				<tbody>
					<th><?php echo $result['mskh']; ?></th>
					<th><?php echo $result['hotenkh']; ?></th>
					<th><p><?php echo $result['username']; ?></p></th>
					<th><p><?php echo $result['password']; ?></p></th>
					<th><?php echo $result['tencongty']; ?></th>	
					<th><?php echo $result['sodienthoai']; ?></th>	
					<th><?php echo $result['sofax']; ?></th>
					<th><?php echo $result['diachi']; ?></th>
				</tbody>	
  	  <?php } ?>
  <?php } ?>
	</table>
</div>