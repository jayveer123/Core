
<?php

$categoryData =  $this->getCategory();  
$categories = $this->getCategories();

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
		<form method="post" action="<?php echo $this->getUrl('category','save',['id'=>$categoryData->id],true) ?>">

				<tr>
				<td><label>Select Root Category :-</label></td>
				<td>
					<select name="category[parent_id]" id="parent_id">
						<option value="" <?php echo ($categoryData->parent_id==NULL) ? "selected" : ''; ?>>Main Category</option>
						<?php foreach ($categories as $category) { ?>
							<?php if($categoryData->id != $category->id){ ?>
							<option value="<?php echo $category->id; ?>" <?php echo ($category->id==$categoryData->parent_id) ? "selected" : ''; ?>>
								<?php echo $this->getPath($category->id,$category->path); ?>
							</option>
							<?php } ?>
						<?php }?>
					</select>
				</td>
				</tr>

				<tr>
				<td><label>Category Name :-</label></td>
				<td><input type="text" name="category[c_name]" id="cname" value="<?php echo $categoryData->c_name; ?>" placeholder="Enter Category name"></td>
				</tr>

				<tr>
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="category[c_stetus]" value="1" <?php if($categoryData->c_stetus==1){echo "checked";} ?>>Active</td>
				<td><input type="radio" name="category[c_stetus]" value="2" <?php if($categoryData->c_stetus==2){echo "checked";} ?>>DeActive</td>
				</tr>

				<tr>
				<td><input type="submit" name="update" id="sub" value="Submit"></td>
				</tr>
		</form>
		</table>
</body>
</html>