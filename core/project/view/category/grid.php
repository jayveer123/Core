<?php

$data = $this->getCategories();

$result = $this->pathAction();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Category Data</title>
</head>
<body>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('category','add',[],true) ?>">Add New</a></button></td>
		</tr>
	</form>
<table align="center" border="1" width="100%">

	<tr>
		<th>Category Id</th>
		<th>Category Name</th>
		<th>Product Stetus</th>
		<th>Path</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	if($data){
		$id=1;

		foreach($data as $row) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $result[$row['id']]; ?></td>
			<td><?php if($row["c_stetus"] == 1){ echo "Active";}else{ echo "Deactive";} ?></td>
			<td><?php echo $row["path"]; ?></td>
			<td><?php echo $row["created_date"]; ?></td>
			<td><?php echo $row["updated_date"]; ?></td>
			<td><a href="<?php echo $this->getUrl('category','edit',['id'=>$row['id']],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('category','delete',['id'=>$row['id']],true) ?>">Delete</a></td>
		</tr>
		<?php 
		$id++;
		} 
	}
	else{
		echo "<tr><td align='center' colspan='9'>No Record Found</td></tr>";
	}
	?>
</table>
</body>
</html>
