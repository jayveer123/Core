<?php

$customer = $this->getCustomer();
$address = $this->getAddress();

?>



	<table align="center" border="1">

<h3 align="center">* Process Record With Customer *</h3>

	<form method="POST" action="<?php echo $this->getUrl('customer','save',['id'=>$customer->id],true) ?>">

	<input type="text" name="customer[id]" value="<?php echo $customer->id; ?>" hidden />

	<input type="text" name="address[customer_id] " value="<?php echo $address->customer_id ?>" hidden>

	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>" id="fname" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>" id="lname" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>Email :-</label></td>
	<td><input type="text" name="customer[email]" value="<?php echo $customer->email; ?>" id="email" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Mobile :-</label></td>
	<td><input type="number" name="customer[mobile]" value="<?php echo $customer->mobile; ?>" id="mobile" placeholder="Enter Mobile"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="customer[stetus]" <?php echo ($customer->getStatus($customer->stetus)=='Active')? 'checked' : ''; ?> value="1">Active
	<input type="radio" name="customer[stetus]" <?php echo ($customer->getStatus($customer->stetus)=='Inactive')? 'checked' : ''; ?> value="2">Inactive</td>
	</tr>

	<tr>
		<td colspan="2" align="center"><b>Address Details</b></td>
	</tr>

	
	<input type="text" name="address[customer_id] " value="<?php echo $address->customer_id ?>" hidden>
	<input type="text" name="address[address_id] " value="<?php echo $address->address_id ?>" hidden>

	<tr>
	<td><label>Address :-</label></td>
	<td><textarea rows="5" cols="20" name="address[address]"><?php echo $address->address; ?></textarea></td>
	</tr>

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
	<td>Billing Address<input type="checkbox" name="address[billing]" value="1" <?php if($address->billing==1){echo "checked";} ?> id="billing"></td>
	<td>Shipping Address<input type="checkbox" name="address[shipping]" value="1" <?php if($address->shipping==1){echo "checked";} ?> id="shipping"></td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	</tr>
</form>
</table>
