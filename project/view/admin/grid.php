<?php $admins=$this->getAdmins(); ?>

<h3 align="center">* Admin Grid *</h3>
	<table border="1" width="100%" cellspacing="4">
		<button><a href="<?php echo $this->getUrl('admin','add') ?>">Add New</a></button>
		<tr>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php 
		if($admins){

			$id=1;

			foreach($admins as $admin) { ?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $admin->firstName; ?></td>
				<td><?php echo $admin->lastName; ?></td>
				<td><?php echo $admin->email; ?></td>
				<td><?php echo $admin->password; ?></td>
				<td><?php echo $admin->getStatus($admin->stetus) ?></td>
				<td><?php echo $admin->createdDate; ?></td>
				<td><?php echo $admin->updatedDate; ?></td>
				<td><a href="<?php echo $this->getUrl('admin','edit',['id'=>$admin->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('admin','delete',['id'=>$admin->id],true) ?>">Delete</a></td>
			</tr>
			<?php 
			$id++;
			}
		}
		else{
			echo "<tr><td align='center' colspan='9'>No Record Found</td></tr>";
		} 
		?>
		
	</table>
	
