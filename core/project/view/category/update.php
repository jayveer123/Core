
<?php



$categories = $this->getCategories();
    
$single_row = $this->getCategory();
    
$result = $this->pathAction();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Data</title>
</head>
<body>
<table align="center">
		<form method="post" action="<?php echo $this->getUrl('category','save',['id'=>$single_row['id']],true) ?>">

				<input type="text" name="category[id]" value="<?php echo $single_row['id']; ?>" hidden />
				<input type="text" name="category[parent_id]" value="<?php echo $single_row['parent_id']; ?>" hidden />

				<tr>
				<td><label>Select Root Category :-</label></td>
				<td>
					<select name="category[root]">
						<option selected value="" <?php echo ($single_row['parent_id']==NULL) ? "selected" : ''; ?>>Main Category</option>
						<?php foreach ($categories as $value) { ?>
							<option value="<?php echo $value['id']; ?>" <?php echo ($value['id']==$single_row['parent_id']) ? "selected" : ''; ?>>
								<?php echo $result[$value['id']]; ?>
							</option>
						<?php }?>
					</select>
				</td>
				</tr>

				<tr>
				<td><label>Category Name :-</label></td>
				<td><input type="text" name="category[c_name]" id="cname" value="<?php echo $single_row['c_name']; ?>" placeholder="Enter Category name"></td>
				</tr>

				<tr>
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="category[c_stetus]" value="1" <?php if($single_row['c_stetus']==1){echo "checked";} ?>>Active</td>
				<td><input type="radio" name="category[c_stetus]" value="2" <?php if($single_row['c_stetus']==2){echo "checked";} ?>>DeActive</td>
				</tr>

				<tr>
				<td><input type="submit" name="update" id="sub" value="Update"></td>
				</tr>
		</form>
		</table>
</body>
</html>