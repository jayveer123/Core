<?php $availabeCustomers = $this->getAvailableCustomers(); ?>
<?php $salesmenCustomers = $this->getCustomers(); ?>

<table border="1" align="center" width="100%">
	<tr>
		<th colspan="5"><h3>All Customer Assign You</h3></th>
	</tr>
	<tr>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
	</tr>
	<?php 
	if($salesmenCustomers){

		$id=1;

		foreach($salesmenCustomers as $customer) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $customer->firstName; ?></td>
			<td><?php echo $customer->lastName; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->mobile; ?></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='5'>No Record Found</td></tr>";
	} 
	?>
</table>

<br><br><br><br>
<form action="<?php echo $this->getUrl('salesmen_salesmenCustomer','save',['id'=> $this->getSalesmenId()],true) ?>" method="post">

<table border="1" align="center" width="100%">
	<tr>
		<th><input type="submit" value="save"></th>
		<th colspan="5"><h3>All Available Customer</h3></th>
	</tr>
	<tr>
		<th>Action</th>
		<th>Customer Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Mobile</th>
	</tr>
	<?php 
	if($availabeCustomers){

		$id=1;

		foreach($availabeCustomers as $customer) { ?>
		<tr>
			<td><input type="checkbox" name="customer[]" value='<?php echo $customer->id; ?>'></td>
			<td><?php echo $id; ?></td>
			<td><?php echo $customer->firstName; ?></td>
			<td><?php echo $customer->lastName; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->mobile; ?></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='6'>No Record Found</td></tr>";
	} 
	?>
</table>
</form>