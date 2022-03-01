<?php

$vendor=$this->getvendor(); 

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud With Class And Methos</title>
</head>
<body>

<h3 align="center">* Insert Record Vendors*</h3>
<table align="center">
<form method="POST" action="<?php echo $this->getUrl('vendor','save',['id'=>$vendor->id],true) ?>">
	<input type="text" name="vendor[id]" hidden value="<?php echo $vendor->id; ?>" placeholder="Enter First name">
	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="vendor[email]" value="<?php echo $vendor->email; ?>" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Mobile :-</label></td>
	<td><input type="number" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>" placeholder="Enter Mobile"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="vendor[status]" value="1" <?php if($vendor->status==1){echo "checked";} ?>>Active</td>
	<td><input type="radio" name="vendor[status]" value="2" <?php if($vendor->status==2){echo "checked";}?>>DeActive</td>
	</tr>

	<tr>
	<td><input type="submit" name="update" id="sub" value="Update"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>