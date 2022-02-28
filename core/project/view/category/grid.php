<?php

$categories = $this->getCategories();




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
		<th>Category Path</th>
		<th>Category Stetus</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Edit</th>
		<th>Delete</th>
		
	</tr>
	<?php 
	if($categories){
		

		foreach($categories as $category) { ?>
		<tr>
			<td><?php echo $category->id; ?></td>
			<td><?php echo $category->c_name; ?></td>
			<td><?php echo $this->getPath($category->id,$category->path); ?></td>
			<td><?php if($category->c_stetus == 1){ echo "Active";}else{ echo "Deactive";} ?></td>
			<td><?php echo $category->createdDate; ?></td>
			<td><?php echo $category->updatedDate; ?></td>
			<td><a href="<?php echo $this->getUrl('category','edit',['id'=>$category->id],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('category','delete',['id'=>$category->id],true) ?>">Delete</a></td>	
		</tr>
		<?php 
		
		} 
	}
	else{
		echo "<tr><td align='center' colspan='9'>No Record Found</td></tr>";
	}
	?>
</table>
</body>
</html>
