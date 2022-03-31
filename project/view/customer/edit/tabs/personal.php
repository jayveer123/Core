<?php $customer = $this->getCustomer(); ?>
<table align="center" border="1">
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
	
	<td><input type="button" id="custSubmit" name="submit" value="Save"></td>
	<td><button type="button" id="cancel">Cancel</button></td>
	</tr>
</table>

<script>
    $("#custSubmit").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>