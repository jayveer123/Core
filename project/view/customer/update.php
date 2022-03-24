<?php

$customer = $this->getCustomer();

$billingAddress = $customer->getBillingAddress();
$shippingAddress = $customer->getShippingAddress();

?>


	<table align="center" border="1">

<h3 align="center">* Process Record With Customer *</h3>

	<form method="POST" action="<?php echo $this->getUrl('customer','save',['id'=>$customer->id],true) ?>">

	<input type="text" name="customer[id]" value="<?php echo $customer->id; ?>" hidden />

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
		<td colspan="2" align="center"><b>BillingAddress Details</b></td>
	</tr>


	<tr>
	<td><label>Address :-</label></td>
	<td><textarea rows="5" cols="20" id="address" name="billingaddress[address]"><?php echo $billingAddress->address; ?></textarea></td>
	</tr>

	<tr>
	<td><label>Postal Code :-</label></td>
	<td><input type="number" id="postal" name="billingaddress[postal_code]" value="<?php echo $billingAddress->postal_code; ?>" id="postal" placeholder="Enter Postal Code"></td>
	</tr>

	<tr>
	<td><label>City :-</label></td>
	<td><input type="text" id="city" name="billingaddress[city]" value="<?php echo $billingAddress->city; ?>" id="city" placeholder="Enter City"></td>
	</tr>

	<tr>
	<td><label>State :-</label></td>
	<td><input type="text" id="state" name="billingaddress[state]" id="state" value="<?php echo $billingAddress->state; ?>" placeholder="Enter State"></td>
	</tr>

	<tr>
	<td><label>Country :-</label></td>
	<td><input type="text" id="country" name="billingaddress[country]" id="country" value="<?php echo $billingAddress->country; ?>" placeholder="Enter country"></td>
	</tr>

	<tr>
	<td><label>Same As Billing Address :-</label></td>
	<td><input type="checkbox" name="same" onclick="myFunction()" id="same" value="1"></td>
	</tr>
		<input type="hidden" name="billingaddress[billing]" value="1">
		<input type="hidden" name="billingaddress[shipping]" value="2">

	<script>
	function myFunction() {
	  var checkBox = document.getElementById("same");
	  	if(checkBox.checked == true){
        	document.getElementById("saddress").value = 
        		document.getElementById("address").value; 
		
			document.getElementById("spostal").value = 
				document.getElementById("postal").value; 
			
			document.getElementById("scity").value = 
				document.getElementById("city").value; 
				
			document.getElementById("sstate").value = 
				document.getElementById("state").value; 
				
			document.getElementById("scountry").value = 
				document.getElementById("country").value; 
     	}
        else{
            document.getElementById("saddress").value = null; 
            document.getElementById("spostal").value = null; 
            document.getElementById("scity").value = null; 
            document.getElementById("sstate").value = null; 
            document.getElementById("scountry").value = null; 
        }
	}
	</script>

	
		<tr>
			<td colspan="2" align="center"><b>ShippingAddress Details</b></td>
		</tr>
		
		<tr>
		<td><label>Address :-</label></td>
		<td><textarea rows="5" id="saddress" cols="20" name="shippingaddress[address]"><?php echo $shippingAddress->address; ?></textarea></td>
		</tr>

		<tr>
		<td><label>Postal Code :-</label></td>
		<td><input type="number" id="spostal" name="shippingaddress[postal_code]" value="<?php echo $shippingAddress->postal_code; ?>" id="postal" placeholder="Enter Postal Code"></td>
		</tr>

		<tr>
		<td><label>City :-</label></td>
		<td><input type="text" id="scity" name="shippingaddress[city]" value="<?php echo $shippingAddress->city; ?>" id="city" placeholder="Enter City"></td>
		</tr>

		<tr>
		<td><label>State :-</label></td>
		<td><input type="text" id="sstate" name="shippingaddress[state]" id="state" value="<?php echo $shippingAddress->state; ?>" placeholder="Enter State"></td>
		</tr>

		<tr>
		<td><label>Country :-</label></td>
		<td><input type="text" id="scountry" name="shippingaddress[country]" id="country" value="<?php echo $shippingAddress->country; ?>" placeholder="Enter country"></td>
		</tr>
			<input type="hidden" name="shippingaddress[shipping]" value="1">
			<input type="hidden" name="shippingaddress[billing]" value="2">

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	</tr>
</form>
</table>
