<?php

$customersData = $this->getCustomers();
$addressData = $this->getAddresses();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customers Data</title>
</head>
<body>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('customer','add') ?>">Add New</a></button></td>
		</tr>
	</form>
<table align="center" border="1" width="100%">

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
	</tr>
	<?php 
	if($customersData){

		$id=1;

		foreach($customersData as $row) { ?>
		<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $row["firstName"]; ?></td>
			<td><?php echo $row["lastName"]; ?></td>
			<td><?php echo $row["email"]; ?></td>
			<td><?php echo $row["mobile"]; ?></td>
			<td><?php if($row["stetus"] == 1){ echo "Active";}else{ echo "Deactive";} ?></td>
			<?php foreach ($addressData as $address){ ?>
				<?php if($address['customer_id']==$row['id']) { ?>
					<td><?php echo $address["address"]; ?></td>
					<td><?php echo $address["postal_code"]; ?></td>
					<td><?php echo $address["city"]; ?></td>
					<td><?php echo $address["state"]; ?></td>
					<td><?php echo $address["country"]; ?></td>
				<?php } ?>
			<?php } ?>
			<td><?php echo $row["createdDate"]; ?></td>
			<td><?php echo $row["updatedDate"]; ?></td>

			<td><a href="<?php echo $this->getUrl('customer','edit',['id'=>$row['id']],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('customer','delete',['id'=>$row['id']],true) ?>">Delete</a></td>
		</tr>
		<?php 
		$id++;
		}
	}
	else{
		echo "<tr><td align='center' colspan='10'>No Record Found</td></tr>";
	} 
	?>
</table>
</body>
</html>
