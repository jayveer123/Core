<?php

$product=$this->getProduct(); 
$categories = $this->getCategories();

?>
<h3 align="center">* Process Record With Product *</h3>

<table align="center">
		<form method="post" action="<?php echo $this->getUrl('save','product',['id'=>$product->id],true) ?>">
			
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
				<td><label>Tax :-</label></td>
				<td><input type="float" name="product[tax]" id="tax" value="<?php echo $product->tax; ?>" placeholder="Enter Product Tax"></td>
				</tr>

				<tr>
				<td><label>Msp :-</label></td>
				<td><input type="float" name="product[msp]" id="pmsp" value="<?php echo $product->msp; ?>" placeholder="Enter Product Msp"></td>
				</tr>

				<tr>
				<td><label>Cost Price :-</label></td>
				<td><input type="float" name="product[cost_price]" id="pcost" value="<?php echo $product->cost_price; ?>" placeholder="Enter Product cost Price"></td>
				</tr>

				<tr>
				<td><label>SKU :-</label></td>
				<td><input type="text" name="product[sku]" id="psku" value="<?php echo $product->sku; ?>" placeholder="Enter Product Sku"></td>
				</tr>

				<tr>
					<td><label>Discount</label></td>
					<td>
						<input type="text" name="product[discount]" value="<?php echo $product->discount ?>">

						In Percentage:<input type="radio" name="discountMethod" value="1">
						&nbsp;&nbsp;&nbsp;
						In Money:<input type="radio" name="discountMethod" value="2">
					</td>
				</tr>

				<tr>
				<td><label>Qyntity :-</label></td>
				<td><input type="number" name="product[p_qun]" id="pqut" value="<?php echo $product->p_qun; ?>" placeholder="Enter Quntity"></td>
				</tr>

				<tr>
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="product[p_stetus]" value="1" <?php echo ($product->getStatus($product->p_stetus)=='Active')? 'checked' : ''; ?>>Active</td>
				<td><input type="radio" name="product[p_stetus]" value="2" <?php echo ($product->getStatus($product->p_stetus)=='Inactive')? 'checked' : ''; ?>>Inactive</td>
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
		            <?php $tag = ($this->selected($category->id)=='checked')?'exists':'new' ?>
		            <tr>
		                <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->id ?>" <?php echo $this->selected($category->id); ?>> </td>
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
