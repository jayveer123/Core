<?php

$vendors=$this->getVendors();
$addressData = $this->getAddresses();

?>

	<h3 align="center">* Vendor Grid *</h3>
	
	<table border="1" width="100%" cellspacing="4">
		<button><a href="<?php echo $this->getUrl('vendor','add') ?>">Add New</a></button>
		<tr>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Address</th>
			<th>Postal</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if($vendors){ ?>
			<?php foreach ($vendors as $vendor) { ?>
			<tr>
				<td><?php echo $vendor->id; ?></td>
				<td><?php echo $vendor->firstName; ?></td>
				<td><?php echo $vendor->lastName; ?></td>
				<td><?php echo $vendor->email; ?></td>
				<td><?php echo $vendor->mobile; ?></td>
				<td><?php echo ($vendor->status==1) ? "Active" : "Inactive"; ?></td>
				<td><?php echo $vendor->createdDate; ?></td>
				<td><?php echo $vendor->updatedDate; ?></td>
				<?php foreach ($addressData as $address){ ?>
				<?php if($address->vendor_id==$vendor->id) { ?>
					<td><?php echo $address->address; ?></td>
					<td><?php echo $address->postal_code; ?></td>
					<td><?php echo $address->city; ?></td>
					<td><?php echo $address->state; ?></td>
					<td><?php echo $address->country; ?></td>
					<?php } ?>
				<?php } ?>
				<td>
					<a href="<?php echo $this->getUrl('vendor','edit',['id'=>$vendor->id],true) ?>">Edit</a>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('vendor','delete',['id'=>$vendor->id],true)?>">Delete</a>
				</td>
			<tr>
			<?php } ?>
		<?php }else{ ?>
			<tr><td colspan="15">No Record Found</td></tr>
		<?php } ?>
	</table>
