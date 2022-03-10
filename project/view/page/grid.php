<?php 

$pages = $this->getPages();

?>

<h3 align="center">* Page Grid *</h3>
	
	<table border="1" width="100%" cellspacing="4">
		<button><a href="<?php echo $this->getUrl('page','add') ?>">Add</a></button>
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
			<tr><td colspan="9">No Record available.</td></tr>
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
		<tr>
			<?php 


			?>
			<td colspan="9" align="right">
				<button>
					<a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getStart()]); ?>" style="<?php echo ($this->pager->getStart()==NULL)? "pointer-events: none" : "" ?>">
						Start
					</a>
				</button>

				<button>
					<a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getPrev()]) ?>" style="<?php echo ($this->pager->getPrev()==NULL)? "pointer-events: none" : "" ?>">
						Prev
					</a>
				</button>

				<button>
					<a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getCurrent()]) ?>">Current</a>
				</button>

				<button>
					<a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getNext()]) ?>" style="<?php echo ($this->pager->getNext()==NULL)? "pointer-events: none" : "" ?>">
						Next
					</a>
				</button>
				<button>
					<a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getEnd()]) ?>" style="<?php echo ($this->pager->getEnd()==NULL)? "pointer-events: none" : "" ?>">
						End
					</a>
				</button>

			</td>
		</tr>
	</table>
