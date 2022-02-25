<?php


$data=$this->getProducts();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product Data</title>
</head>
<body>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('product','add') ?>">Add New</a></button></td>
		</tr>
	</form>
<table align="center" border="1">

	<tr>
		<th>Product Id</th>
		<th>Base Image</th>
		<th>Thumb Image</th>
		<th>Small Image</th>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Product Quntity</th>
		<th>Product Stetus</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Media</th>
	</tr>
	<?php 
	if($data){

		$id=1;

		foreach($data as $row) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td>
				<?php if($row['base']){ ?>
				<img src="<?php echo 'Media/Product/'.$row['base']; ?>" width=50 height=50>
				<?php }else{
					echo "No image Set";
				} ?>
			</td>

			<td>
				<?php if($row['thumb']){ ?>
				<img src="<?php echo 'Media/Product/'.$row['thumb']; ?>"  width=50 height=50>
				<?php }else{
					echo "No image Set";
				} ?>
			</td>

			<td>
				<?php if($row['small']){ ?>
				<img src="<?php echo 'Media/Product/'.$row['small']; ?>"  width=50 height=50>
				<?php }else{
					echo "No image Set";
				} ?>
			</td>
			<td><?php echo $row["p_name"]; ?></td>
			<td><?php echo $row["p_price"]; ?></td>
			<td><?php echo $row["p_qun"]; ?></td>
			<td><?php if($row["p_stetus"] == 1){ echo "Active";}else{ echo "Deactive";} ?></td>
			<td><?php echo $row["created_date"]; ?></td>
			<td><?php echo $row["updated_date"]; ?></td>
			<td><a href="<?php echo $this->getUrl('product','edit',['id'=>$row['id']],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('product','delete',['id'=>$row['id']],true) ?>">Delete</a></td>
			<td><a href="<?php echo $this->getUrl('product_media','grid',['id'=>$row['id']],true) ?>">Media</a></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='13'>No Record Found</td></tr>";
	} 
	?>
</table>
</body>
</html>