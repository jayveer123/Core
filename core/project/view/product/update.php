<?php

$product=$this->getProduct(); 


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
		<form method="post" action="<?php echo $this->getUrl('product','save',['id'=>$product->id],true) ?>">
			
				<input type="text" name="product[id]" value="<?php echo $product->id; ?>" hidden />
				
				<tr>
				<td><label>Product Name :-</label></td>
				<td><input type="text" name="product[p_name]" id="pname" value="<?php echo $product->p_name; ?>" placeholder="Enter Product name"></td>
				</tr>

				<tr>
				<td><label>Price :-</label></td>
				<td><input type="float" name="product[p_price]" id="pprice" value="<?php echo $product->p_price; ?>" placeholder="Enter Product Price"></td>
				</tr>

				<tr>
				<td><label>Qyntity :-</label></td>
				<td><input type="number" name="product[p_qun]" id="pqut" value="<?php echo $product->p_qun; ?>" placeholder="Enter Quntity"></td>
				</tr>

				<tr>
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="product[p_stetus]" value="1" <?php if($product->p_stetus==1){echo "checked";} ?>>Active</td>
				<td><input type="radio" name="product[p_stetus]" value="2" <?php if($product->p_stetus==2){echo "checked";} ?>>DeActive</td>
				</tr>

				<tr>
				<td><input type="submit" name="update" id="sub" value="update"></td>
				</tr>
		</form>
		</table>
</body>
</html>