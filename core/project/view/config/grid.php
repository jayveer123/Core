<?php 

$configs = $this->getConfigs();

?>


<h3 align="center">* Config Grid *</h3>
	
	<table border="1" width="100%" cellspacing="4">

		<button><a href="<?php echo $this->getUrl('config','add') ?>">Add New</a></button>
		
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
				<td><?php echo $config->updatedDate ?></td>
				<td><a href="<?php echo $this->getUrl('config','edit',['id'=>$config->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('config','delete',['id'=>$config->id],true) ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
