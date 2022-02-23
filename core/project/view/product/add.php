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
<form method="POST" action="index.php?c=product&a=save">

	<tr>
	<td><label>Product Name :-</label></td>
	<td><input type="text" name="product[p_name]" id="pname" placeholder="Enter Product name"></td>
	</tr>

	<tr>
	<td><label>Price :-</label></td>
	<td><input type="float" name="product[p_price]" id="pprice" placeholder="Enter Product Price"></td>
	</tr>

	<tr>
	<td><label>Qyntity :-</label></td>
	<td><input type="number" name="product[p_qun]" id="pqut" placeholder="Enter Quntity"></td>
	</tr>

	<tr>
	<td><label>Stetus :-</label></td>
	<td><input type="radio" name="product[p_stetus]" value="1">Active</td>
	<td><input type="radio" name="product[p_stetus]" value="2">DeActive</td>
	</tr>

	<tr>
	<td><input type="submit" name="submit" id="sub" value="Save"></td>
	<td><input type="reset" name="res" id="res" value="Reset"></td>
	</tr>
</form>
</table>


</body>
</hrml>