<?php
$billingAddress = $this->getBillingAddress();
$shippingAddress = $this->getShippingAddress();

?>
<table align="center" border="1">
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
		<td><input type="button" name="submit" id="addressSubmit" value="Update"></td>
		<td><button type="button" id="cancel">Cancel</button></td>
		</tr>
</table>

<script>
    $("#addressSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>