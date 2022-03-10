<?php $page=$this->getPage();  ?>

<h3 align="center">* Record Process With Page *</h3>

<form action="<?php echo $this->getUrl('page','save',['id'=>$page->id],true) ?>" method="POST">
	<table align="center" border="1" cellspacing="4">
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
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="page[status]" value="1" <?php echo ($page->getStatus($page->status)=='Active')? 'checked' : ''; ?>>Active
				<input type="radio" name="page[status]" value="2" <?php echo ($page->getStatus($page->status)=='Inactive')? 'checked' : ''; ?>>Inactive</td>
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
