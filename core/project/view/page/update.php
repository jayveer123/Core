<?php $page=$this->getPage();  ?>

<html>
<head><title>Config Edit</title></head>
<body>

<form action="<?php echo $this->getUrl('page','save',['id'=>$page->id],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Config Information</b></td>
		</tr>
		<tr>
			<td width="10%">Name<input type="text" name="page[id]" value="<?php echo $page->id ?>" hidden></td>
			<td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Code</td>
			<td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
		</tr>
		<tr>
			<td width="10%">Value</td>
			<td><textarea rows="10" name="page[content]" cols="20"><?php echo $page->content ?></textarea></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="page[status]">
					<option value="1" <?php echo ($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="<?php echo $this->getUrl('page','grid',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>