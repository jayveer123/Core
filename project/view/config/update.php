<?php $config=$this->getConfig();  ?>

<h3 align="center">* Proceess Record With Config *</h3>

<form action="<?php echo $this->getUrl('config','save',['id'=>$config->id],true) ?>" method="POST">
	<table align="center">
		
		<tr>
			<td width="10%">Name<input type="text" name="config[id]" value="<?php echo $config->id ?>" hidden></td>
			<td><input type="text" name="config[name]" value="<?php echo $config->name ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Code</td>
			<td><input type="text" name="config[code]" value="<?php echo $config->code ?>"></td>
		</tr>
		<tr>
			<td width="10%">Value</td>
			<td><input type="text" name="config[value]" value="<?php echo $config->value ?>"></td>
		</tr>

		<tr>
				<td><label>Stetus :-</label></td>
				<td><input type="radio" name="config[status]" value="1" <?php if($config->getStatus($config->status)==1){echo "checked";} ?>>Active</td>
				<td><input type="radio" name="config[status]" value="2" <?php if($config->getStatus($config->status)==2){echo "checked";} ?>>DeActive</td>
				</tr>

		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="<?php echo $this->getUrl('config','grid',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
