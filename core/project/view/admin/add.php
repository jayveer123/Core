<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud With Class And Methos</title>
</head>
<body>

<h3 align="center">* Insert Record *</h3>
<table align="center">
<form method="POST" action="index.php?c=admin&a=save">

	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="admin[firstName]" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="admin[lastName]" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>email :-</label></td>
	<td><input type="email" name="admin[email]" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Password :-</label></td>
	<td><input type="password" name="admin[password]" placeholder="Enter Password"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="admin[stetus]" value="1">Active</td>
	<td><input type="radio" name="admin[stetus]" value="2">DeActive</td>
	</tr>

	<tr>
	<td><input type="submit" name="submit" id="sub" value="Add New"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>