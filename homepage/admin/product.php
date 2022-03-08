<?php 
	require_once("db_connect.php");
	require_once("php/header.php");
	require_once("php/sidebar.php");
    $sql = "SELECT h.mshh, img.tenhinh, h.tenhh, h.quycach, h.gia, h.soluonghang, l.tenloaihang FROM hanghoa h join hinhhanghoa img on h.mshh = img.mshh join loaihanghoa l on h.maloaihang = l.maloaihang"; 
    $query = mysqli_query($conn,$sql);

?>

    
<div class="container">
	<table>
		<thead>
			<th colspan="9" style="border-bottom: 2px solid #dddddd; font-size: 50px; color: white; background-color: #22242A;">Kho hàng tồn kho</th>
		</thead>
		<thead>
			<th>Mã</th>
			<th>Sản phẩm</th>
			<th>Tên sản phẩm</th>
			<th>Quy cách</th>
			<th>Giá</th>
			<th>Số lượng</th>
			<th>Mã loại hàng</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</thead>	
		<?php 
		while($result = mysqli_fetch_array($query)) { ?>
			<tbody>
				<th><?php echo $result['mshh']; ?></th>
				<th><img src="image/<?php echo $result['tenhinh']; ?>" width="200px"></th>
				<th><p><?php echo $result['tenhh']; ?></p></th>
				<th><p><?php echo $result['quycach']; ?></p></th>
				<th><?php echo $result['gia']; ?><sup>đ</sup></th>	
				<th><?php echo $result['soluonghang']; ?></th>	
				<th><?php echo $result['tenloaihang']; ?></th>
				<th><a href="edit.php?ms_hh=<?php echo $result['mshh']; ?>"><i class="fas fa-edit">Update</i></a></th>
				<th><a href="delete.php?ms_hh=<?php echo $result['mshh']; ?>"><i class="fas fa-trash-alt">Xóa</i></a></th>
			</tbody>	
  <?php } ?>
  		<thead>
  			<th colspan="9" style="border-top: 2px solid #dddddd;"><a href="add.php"><i class="fas fa-edit"> Thêm sản phẩm</i></a></th>
  		</thead>
	</table>
</div>