<?php 

$configs = $this->getConfigs();

?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Config Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Value</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$configs):  ?>
			<tr><td colspan="8">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($configs as $config): ?>
			<tr>
				<td><?php echo $config->id ?></td>
				<td><?php echo $config->name ?></td>
				<td><?php echo $config->code ?></td>
				<td><?php echo $config->value ?></td>
				<td><?php echo $config->getStatus($config->status)?></td>
				<td><?php echo $config->createdDate ?></td>
				<td><a href="<?php echo $this->getUrl('edit','config',['id'=>$config->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','config',['id'=>$config->id],true) ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>