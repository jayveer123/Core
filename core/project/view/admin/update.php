<?php

$data=$this->getAdmin(); 

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud With Class And Methos</title>
</head>
<body>

<h3 align="center">* Insert Record *</h3>
<table align="center">
<form method="POST" action="<?php echo $this->getUrl('admin','save',['id'=>$data['id']],true) ?>">
	<input type="text" name="admin[id]" hidden value="<?php echo $data['id']; ?>" placeholder="Enter First name">
	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="admin[firstName]" value="<?php echo $data['firstName']; ?>" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="admin[lastName]" value="<?php echo $data['lastName']; ?>" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="admin[email]" value="<?php echo $data['email']; ?>" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Password :-</label></td>
	<td><input type="password" name="admin[password]" value="<?php echo $data['password']; ?>" placeholder="Enter Password"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="admin[stetus]" value="1" <?php if($data['stetus']==1){echo "checked";} ?>>Active</td>
	<td><input type="radio" name="admin[stetus]" value="2" <?php if($data['stetus']==2){echo "checked";}?>>DeActive</td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>