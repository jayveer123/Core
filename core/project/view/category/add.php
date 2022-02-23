<?php
	$data = $this->getCategories();
    $result = $this->pathAction();

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud With Class And Methos</title>
</head>
<body>
<h3 align="center">* Insert Record *</h3>
<table align="center">
<form method="post" action="index.php?c=category&a=save">

	<tr>
	<td><label>Select Root Category :-</label></td>
	<td>
		<select name="category[parent_id]">
			<option selected value="">Main Category</option>
			<?php foreach ($data as $row) { ?>
			<option value="<?php echo $row['id']; ?>">
			<?php echo $result[$row['id']]; ?>
			</option>
			<?php }?>
		</select>
	</td>
	</tr>	

	<tr>
	<td><label>Category Name :-</label></td>
	<td><input type="text" name="category[c_name]" id="cname" placeholder="Enter Category name"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="category[c_stetus]" value="1">Active</td>
	<td><input type="radio" name="category[c_stetus]" value="2">DeActive</td>
	</tr>

	<tr>
	<td><input type="submit" name="submit" id="sub" value="Save"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>