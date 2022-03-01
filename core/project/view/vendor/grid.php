<?php

$vendors=$this->getvendors();

?>
<html>
<head>
</head>
<body>
	<h3 align="center">Vendor</h3>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('vendor','add') ?>">Add New</a></button></td>
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
		<?php if($vendors){ ?>
			<?php foreach ($vendors as $vendor) { ?>
				<td><?php echo $vendor->id; ?></td>
				<td><?php echo $vendor->firstName; ?></td>
				<td><?php echo $vendor->lastName; ?></td>
				<td><?php echo $vendor->email; ?></td>
				<td><?php echo $vendor->mobile; ?></td>
				<td><?php echo ($vendor->status==1) ? "Active" : "Inactive"; ?></td>
				<td><?php echo $vendor->createdDate; ?></td>
				<td><?php echo $vendor->updatedDate; ?></td>
				<td>
					<a href="<?php echo $this->getUrl('vendor','edit',['id'=>$vendor->id],true) ?>">Edit</a>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('vendor','delete',['id'=>$vendor->id],true)?>">Delete</a>
				</td>
			<?php } ?>
		<?php }else{ ?>
			<td colspan="10">No Record Found</td>
		<?php } ?>
	</table>
	
</body>