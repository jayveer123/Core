<?php

$salesmens=$this->getSalesmens();

?>
<html>
<head>
</head>
<body>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('salesmen','add') ?>">Add New</a></button></td>
		</tr>
	</form>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if($salesmens){ ?>
			<?php foreach ($salesmens as $salesmen) { ?>
				<td><?php echo $salesmen->id; ?></td>
				<td><?php echo $salesmen->firstName; ?></td>
				<td><?php echo $salesmen->lastName; ?></td>
				<td><?php echo $salesmen->email; ?></td>
				<td><?php echo $salesmen->mobile; ?></td>
				<td><?php echo ($salesmen->status==1) ? "Active" : "Inactive"; ?></td>
				<td><?php echo $salesmen->createdDate; ?></td>
				<td><?php echo $salesmen->updatedDate; ?></td>
				<td>
					<a href="<?php echo $this->getUrl('salesmen','edit',['id'=>$salesmen->id],true) ?>">Edit</a>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('salesmen','delete',['id'=>$salesmen->id],true)?>">Delete</a>
				</td>
			<?php } ?>
		<?php }else{ ?>
			<td colspan="10">No Record Found</td>
		<?php } ?>
	</table>
	
</body>