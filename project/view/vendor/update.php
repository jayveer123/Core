<?php

$vendor=$this->getvendor(); 

$address = $vendor->getAddress();

?>


<h3 align="center">* Process Record With Vendor *</h3>
<table align="center">
<form method="POST" action="<?php echo $this->getUrl('vendor','save',['id'=>$vendor->id],true) ?>">
	<input type="text" name="vendor[id]" hidden value="<?php echo $vendor->id; ?>" placeholder="Enter First name">
	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="vendor[email]" value="<?php echo $vendor->email; ?>" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Mobile :-</label></td>
	<td><input type="number" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>" placeholder="Enter Mobile"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="vendor[status]" value="1" <?php echo ($vendor->getStatus($vendor->status)=='Active')? 'checked' : ''; ?>>Active</td>
	<td><input type="radio" name="vendor[status]" value="2" <?php echo ($vendor->getStatus($vendor->status)=='Inactive')? 'checked' : ''; ?>>Inactive</td>
	</tr>

	<tr>
		<td colspan="2" align="center"><b>Address Details</b></td>
	</tr>
	
	<tr>
	<td><label>Address :-</label></td>
	<td><textarea rows="5" cols="20" name="address[address]"><?php echo $address->address; ?></textarea></td>
	</tr>

	<!-- <input type="text" name="address[vendor_id] " value="<?php //echo $address->vendor_id ?>" hidden> -->
	<input type="text" name="address[id] " value="<?php echo $address->id ?>" hidden>

	<tr>
	<td><label>Postal Code :-</label></td>
	<td><input type="number" name="address[postal_code]" value="<?php echo $address->postal_code; ?>" id="postal" placeholder="Enter Postal Code"></td>
	</tr>

	<tr>
	<td><label>City :-</label></td>
	<td><input type="text" name="address[city]" value="<?php echo $address->city; ?>" id="city" placeholder="Enter City"></td>
	</tr>

	<tr>
	<td><label>State :-</label></td>
	<td><input type="text" name="address[state]" id="state" value="<?php echo $address->state; ?>" placeholder="Enter State"></td>
	</tr>

	<tr>
	<td><label>Country :-</label></td>
	<td><input type="text" name="address[country]" id="country" value="<?php echo $address->country; ?>" placeholder="Enter country"></td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>
