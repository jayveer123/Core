<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud With Class And Methos</title>
</head>
<body>

<h3 align="center">* Insert Record *</h3>
<table align="center" border="1">
<form method="POST" action="index.php?c=customer&a=save">

	<tr>
	<td><label>First Name :-</label></td>
	<td><input type="text" name="customer[firstName]" id="fname" placeholder="Enter First name"></td>
	</tr>

	<tr>
	<td><label>Last Name :-</label></td>
	<td><input type="text" name="customer[lastName]" id="lname" placeholder="Enter Last name"></td>
	</tr>

	<tr>
	<td><label>Email :-</label></td>
	<td><input type="text" name="customer[email]" id="email" placeholder="Enter Email"></td>
	</tr>

	<tr>
	<td><label>Mobile :-</label></td>
	<td><input type="number" name="customer[mobile]" id="mobile" placeholder="Enter Mobile"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="customer[stetus]" value="1">Active
	<input type="radio" name="customer[stetus]" value="2">DeActive</td>
	</tr>

	

	<tr>
		<td colspan="2" align="center"><b>Address Details</b></td>
	</tr>

	<tr>
	<td><label>Address :-</label></td>
	<td><textarea rows="5" cols="20" name="address[address]"></textarea></td>
	</tr>

	<tr>
	<td><label>Postal Code :-</label></td>
	<td><input type="number" name="address[postal_code]" id="postal" placeholder="Enter Postal Code"></td>
	</tr>

	<tr>
	<td><label>City :-</label></td>
	<td><input type="text" name="address[city]" id="city" placeholder="Enter City"></td>
	</tr>

	<tr>
	<td><label>State :-</label></td>
	<td><input type="text" name="address[state]" id="state" placeholder="Enter State"></td>
	</tr>

	<tr>
	<td><label>Country :-</label></td>
	<td><input type="text" name="address[country]" id="country" placeholder="Enter country"></td>
	</tr>

	<tr>
	<td>Billing Address<input type="checkbox" name="address[billing]" value="1" id="billing"></td>
	<td>Shipping Address<input type="checkbox" name="address[shipping]" value="1" id="shipping"></td>
	</tr>

	<tr>
	<td><input type="submit" name="submit" id="sub" value="Save"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>