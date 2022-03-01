<?php 

$pages = $this->getPages();

?>
<html>
<head>
</head>
<body>
	<form align="center">
		<tr>
			<button><a href="<?php echo $this->getUrl('page','add') ?>">Add</a></button>
		</tr>
	</form>
	
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Page Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Content</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$pages):  ?>
			<tr><td colspan="8">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($pages as $page): ?>
			<tr>
				<td><?php echo $page->id ?></td>
				<td><?php echo $page->name ?></td>
				<td><?php echo $page->code ?></td>
				<td><?php echo $page->content ?></td>
				<td><?php echo $page->getStatus($page->status)?></td>
				<td><?php echo $page->createdDate ?></td>
				<td><?php echo $page->updatedDate ?></td>
				<td><a href="<?php echo $this->getUrl('page','edit',['id'=>$page->id],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('page','delete',['id'=>$page->id],true) ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>