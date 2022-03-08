<?php

$categories = $this->getCategories();



?>
<h3 align="center">Catgory Grid</h3>
<table align="center" border="1" width="100%">
	<button><a href="<?php echo $this->getUrl('category','add',[],true) ?>">Add New</a></button>
	<tr>
		<th>Category Id</th>
		<th>Category Name</th>
		<th>Category Path</th>
		<th>Category Stetus</th>
		<th>Base</th>
		<th>Thumb</th>
		<th>Small</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Media</th>
	</tr>
	<?php 
	if($categories){
		

		foreach($categories as $category) { ?>
		<tr>
			<td><?php echo $category->id; ?></td>
			<td><?php echo $category->c_name; ?></td>
			<td><?php echo $this->getPath($category->id,$category->path); ?></td>
			<td><?php if($category->c_stetus == 1){ echo "Active";}else{ echo "Deactive";} ?></td>

			<td>

				<img src="<?php if($category->base){echo "Media/Category/".$this->getMedia($category->base)['imageName']; }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php if($category->thumb){ echo "Media/Category/".$this->getMedia($category->thumb)['imageName']; }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td>
				<img src="<?php if($category->small){ echo "Media/Category/".$this->getMedia($category->small)['imageName']; }  ?>" alt="No Image Found" width="50" height="50">
			</td>

			<td><?php echo $category->createdDate; ?></td>
			<td><?php echo $category->updatedDate; ?></td>
			<td><a href="<?php echo $this->getUrl('category','edit',['id'=>$category->id],true) ?>">Edit</a></td>
			<td><a href="<?php echo $this->getUrl('category','delete',['id'=>$category->id],true) ?>">Delete</a></td>
			<td><a href="<?php echo $this->getUrl('category_media','grid',['id'=>$category->id],true) ?>">Media</a></td>
		</tr>
		<?php 
		
		} 
	}
	else{
		echo "<tr><td align='center' colspan='9'>No Record Found</td></tr>";
	}
	?>
</table>

