<?php

$customersData = $this->getCustomers();
$addressData = $this->getAddresses();



?>

<h3 align="center">* Customer Grid *</h3>
	
<table align="center" border="1" width="100%">
	<button><a href="<?php echo $this->getUrl('customer','add') ?>">Add New</a></button>
	<tr>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
		<th>Stetus</th>
		<th>Address</th>
		<th>Postal Code</th>
		<th>City</th>
		<th>State</th>
		<th>Country</th>
		<th>Created Date</th>
		<th>Updated Date</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Set Price</th>
	</tr>
	<?php 
	if($customersData){

		$id=1;

		foreach($customersData as $customer) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $customer->firstName; ?></td>
			<td><?php echo $customer->lastName; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->mobile; ?></td>
			<td><?php echo $customer->getStatus($customer->stetus) ?></td>
			<?php foreach ($addressData as $address){ ?>
				<?php if($address->customer_id==$customer->id) { ?>
					<td><?php echo $address->address; ?></td>
					<td><?php echo $address->postal_code; ?></td>
					<td><?php echo $address->city; ?></td>
					<td><?php echo $address->state; ?></td>
					<td><?php echo $address->country; ?></td>
				<?php } ?>
			<?php } ?>
			<td><?php echo $customer->createdDate; ?></td>
			<td><?php echo $customer->updatedDate; ?></td>

			<td><a href="<?php echo $this->getUrl('customer','edit',['id'=>$customer->id],true) ?>">Edit</a></td>

			<td><a href="<?php echo $this->getUrl('customer','delete',['id'=>$customer->id],true) ?>">Delete</a></td>

			<td><a href="<?php echo $this->getUrl('customer_price','grid',['id'=>$customer->id],true) ?>">Set Price</a></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='15'>No Record Found</td></tr>";
	} 
	?>
</table>
</body>
</html>
