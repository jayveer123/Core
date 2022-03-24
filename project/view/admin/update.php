<?php

$admin=$this->getAdmin(); 

?>


<h3 align="center">* Data Process For Admin *</h3>
<table align="center">
<form method="POST" action="<?php echo $this->getUrl('admin','save',['id'=>$admin->id],true) ?>">
	<input type="text" name="admin[id]" hidden value="<?php echo $admin->id; ?>" placeholder="Enter First name">
	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName; ?>" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName; ?>" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="admin[email]" value="<?php echo $admin->email; ?>" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Password :-</label></td>
	<td><input type="password" name="admin[password]" value="<?php echo $admin->password; ?>" placeholder="Enter Password"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="admin[stetus]" value="1" <?php echo ($admin->getStatus($admin->stetus)=='Active')? 'checked' : ''; ?>>Active</td>
	<td><input type="radio" name="admin[stetus]" value="2" <?php echo ($admin->getStatus($admin->stetus)=='Inactive')? 'checked' : ''; ?>>Inactive</td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Save"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>
