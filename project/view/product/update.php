<?php

$product=$this->getProduct(); 
$categories = $this->getCategories();

?>
<h3 align="center">* Process Record With Product *</h3>

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

		        <table border="1" align="center">
		            <tr>
		                <th>Select</th>
		                <th>Category Id</th>
		                <th>Category</th>
		            </tr>
		            <?php if(!$categories): ?>
		            <tr>
		                <td colspan="3">No category Found</td>
		            </tr>
		            <?php else: ?>
		            <?php foreach($categories as $category): ?>
		            
		            <tr>
		                <td> <input type="checkbox" name="category[]" value="<?php echo $category->id ?>" <?php echo $this->selected($category->id); ?>> </td>
		                <td><?php echo $category->id; ?></td>
		                <td><?php echo $this->getPath($category->id,$category->path); ?></td>
		            </tr>

		            <?php endforeach; ?>

		            <?php endif; ?>
		        </table>

				<tr>
				<td><input type="submit" name="update" id="sub" value="update"></td>
				</tr>
		</form>
		</table>
