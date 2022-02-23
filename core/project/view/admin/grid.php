<?php

$data=$this->getAdmins();

?>
<html>
<head>
</head>
<body>
	<form align="center">
		<tr>
			<td><button><a href="<?php echo $this->getUrl('admin','add') ?>">Add New</a></button></td>
		</tr>
	</form>
	<table border="1" width="100%" cellspacing="4">
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
		if($data){

			$id=1;

			foreach($data as $row) { ?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $row["firstName"]; ?></td>
				<td><?php echo $row["lastName"]; ?></td>
				<td><?php echo $row["email"]; ?></td>
				<td><?php echo $row["password"]; ?></td>
				<td><?php if($row["stetus"] == 1){ echo "Active";}else{ echo "Deactive";} ?></td>
				<td><?php echo $row["createdDate"]; ?></td>
				<td><?php echo $row["updatedDate"]; ?></td>
				<td><a href="<?php echo $this->getUrl('admin','edit',['id'=>$row['id']],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('admin','delete',['id'=>$row['id']],true) ?>">Delete</a></td>
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
	
</body>