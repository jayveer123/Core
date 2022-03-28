<?php

$salesmen=$this->getSalesmen(); 

?>


<h3 align="center">* Process Record With Salesman *</h3>
<table align="center">
<form method="POST" action="<?php echo $this->getUrl('save','salesmen',['id'=>$salesmen->id],true) ?>">
	<input type="text" name="salesmen[id]" hidden value="<?php echo $salesmen->id; ?>" placeholder="Enter First name">
	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="salesmen[firstName]" value="<?php echo $salesmen->firstName; ?>" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="salesmen[lastName]" value="<?php echo $salesmen->lastName; ?>" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="salesmen[email]" value="<?php echo $salesmen->email; ?>" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Mobile :-</label></td>
	<td><input type="number" name="salesmen[mobile]" value="<?php echo $salesmen->mobile; ?>" placeholder="Enter Mobile"></td>
	</tr>

	<tr>
	<td><label>Margin :-</label></td>
	<td><input type="float" name="salesmen[margin]" value="<?php echo $salesmen->margin; ?>" placeholder="Enter Margin"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="salesmen[status]" value="1" <?php echo ($salesmen->getStatus($salesmen->status)=='Active')? 'checked' : ''; ?>>Active</td>
	<td><input type="radio" name="salesmen[status]" value="2" <?php echo ($salesmen->getStatus($salesmen->status)=='Inactive')? 'checked' : ''; ?>>Inactive</td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>
