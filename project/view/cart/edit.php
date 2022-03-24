<?php 
$customers = $this->getCustomers(); 
$cart = $this->getCart();

$customer = $cart->customer;
$bilingAddress = $cart->bilingAddress;
$shipingAddress = $cart->shipingAddress;
$item = $cart->item;


$items = $this->getItems();
$products = $this->getProducts();

$disabled = (!$items)?'disabled':"";

?>
<select onchange="change(this.value)">
	<option value="">Select</option>
	<?php foreach($customers as $cust): ?>
	<option value="<?php echo $cust->id ?>"><?php echo $cust->firstName." ".$cust->email; ?></option>
	<?php endforeach; ?>
</select>

<h3>Customer Data</h3>

<table border="1">
	<tr>
		<td>First Name</td>
		<td>Last Name</td>
	</tr>
	<tr>
		<td><?php echo $customer->firstName; ?></td>
		<td><?php echo $customer->lastName; ?></td>
	</tr>
</table>

<form action="<?php echo $this->getUrl('cart','saveCartAddress'); ?>" method="post">
	<table border="1">
		<tr>
			<th>Biling Address</th>
			<th>Shiping Address</th>
		</tr>
		<tr>
			<td>
				<table border="1">
					<tr>
						<input type="hidden" name="bilingAddress[billing]" value="1">
						<input type="hidden" name="bilingAddress[shipping]" value="2">
						<td>First Name</td>
						<td><input type="text" name="bilingAddress[firstName]" id="firstName" value="<?php echo $bilingAddress->firstName; ?>"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="bilingAddress[lastName]" id="lastName" value="<?php echo $bilingAddress->lastName; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="bilingAddress[address]" id="address" value="<?php echo $bilingAddress->address; ?>"></td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td><input type="text" name="bilingAddress[postal_code]" id="postalCode" value="<?php echo $bilingAddress->postal_code; ?>"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="bilingAddress[city]" id="city" value="<?php echo $bilingAddress->city; ?>"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="bilingAddress[state]" id="state" value="<?php echo $bilingAddress->state; ?>"></td>
					</tr>
					
					<tr>
						<td>Country</td>
						<td><input type="text" name="bilingAddress[country]" id="country" value="<?php echo $bilingAddress->country; ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="sameAsShipint" id="hardik" onclick="same()">same as shiping address
							<br>
							<input type="checkbox" name="saveInBilingBook" value=1>save in address book
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table border="1">

						<tr>
							<input type="hidden" name="shipingAddress[billing]" value="2">
							<input type="hidden" name="shipingAddress[shipping]" value="1">
							<td>First Name</td>
							<td><input type="text" name="shipingAddress[firstName]" id="firstName1" value="<?php echo $shipingAddress->firstName; ?>"></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="shipingAddress[lastName]" id="lastName1" value="<?php echo $shipingAddress->lastName; ?>"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="shipingAddress[address]" id="address1" value="<?php echo $shipingAddress->address; ?>"></td>
						</tr>
						<tr>
							<td>Postal Code</td>
							<td><input type="text" name="shipingAddress[postal_code]" id="postalCode1" value="<?php echo $shipingAddress->postal_code; ?>"></td>
						</tr>
						<tr>
							<td>City</td>
							<td><input type="text" name="shipingAddress[city]" id="city1" value="<?php echo $shipingAddress->city; ?>"></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="shipingAddress[state]" id="state1" value="<?php echo $shipingAddress->state; ?>"></td>
						</tr>
						
						<tr>
							<td>Country</td>
							<td><input type="text" name="shipingAddress[country]" id="country1" value="<?php echo $shipingAddress->country; ?>"></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="checkbox" name="saveInShipingBook">save in address book
							</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="save">
			</td>
		</tr>
	</table>
</form>

<table border="1">
	<tr>
		<th>Payment Method</th>
		<th>Shiping Method</th>
	</tr>
	<tr>
		<td>
			<form action="<?php echo $this->getUrl('cart','savePaymentMethod') ?>" method="post">
				<input type="radio" name="paymentMethod" value="1" >Credit/Debit <br>
				<input type="radio" name="paymentMethod" value="2">UPI <br>
				<input type="radio" name="paymentMethod" value="3">QR <br>
				<input type="radio" name="paymentMethod" value="4" checked>Case On Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
		<td>
			<form action="<?php echo $this->getUrl('cart','saveShippingMethod') ?>" method="post">
				<input type="radio" name="shippingMethod" value="100">Same Day Delivery <br>
				<input type="radio" name="shippingMethod" value="50">Express <br>
				<input type="radio" name="shippingMethod" value="20" checked>Normal Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
	</tr>
</table>
<div id="productTable">
	<form action="<?php echo $this->getUrl('cart','addCartItem') ?>" method="post">
		<table border="1">
			<tr>
				<td colspan="6" align="center"><h3>Add New Product</h3></td>
			</tr>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Row Tatal</th>
				<th>Action</th>
			</tr>
			<?php if(!$products): ?>
			<tr>
				<td colspan="6">No more products availabel</td>
			</tr>
			<?php else: ?>
			<?php $i = 0; ?>
			<?php foreach($products as $product): ?>
			<?php $image = (!$product->getBase()->imageName)?"":$product->getBase()->imageName; ?>
			<tr>
				<td><img src="Media/Product/<?php echo $image; ?>" alt="image not found" width="50" hight="50"></td>
				<td><?php echo $product->p_name; ?></td>
				<td><input type="number" name="cartItem[<?php echo $i ?>][quntity]"></td>
				<td><?php echo $product->p_price; ?></td>
				<td>200</td>
				<td><input type="checkbox" name="cartItem[<?php echo $i ?>][product_id]" value="<?php echo $product->id ?>"></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<tr>
				<td align="center" colspan="6">
					<input type="submit" value="Add">
					<button type="button" id="hideProduct">Cancel</button>
				</td>
			</tr>
		</table>
	</form>
</div>
<br><br>
<form action="<?php echo $this->getUrl('cart','cartItemUpdate') ?>" method="post">
		
		<table border="1">
			<tr>
				<td colspan="6" align="center"><h3>All Added Item</h3></td>
			</tr>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Row Tatal</th>
				<th>Action</th>
			</tr>
			<?php if(!$items): ?>
			<tr>
				<td colspan="6">no item found</td>
			</tr>
			<?php else: ?>
			<?php $i = 0; ?>
			<?php foreach($items as $item): ?>
			<?php $image = (!$item->getProduct()->getBase()->imageName)?"":$item->getProduct()->getBase()->imageName; ?>
			<tr>
				<input type="hidden" name="cartItem[<?php echo $i ?>][item_id]" value="<?php echo $item->item_id ?>">

				<input type="hidden" name="cartItem[<?php echo $i ?>][product_id]" value="<?php echo $item->product_id ?>">

				<td><img src="Media/Product/<?php echo $image; ?>" alt="image not found" width="50" hight="50"></td>

				<td><?php echo $item->getProduct()->p_name; ?></td>

				<td><input type="number" name="cartItem[<?php echo $i ?>][quntity]" value="<?php echo $item->quntity; ?>"></td>

				<td><?php echo $item->getProduct()->p_price; ?></td>

				<td><?php echo $item->itemTotal; ?></td>

				<td><a href="<?php echo $this->getUrl(null,'deleteCartItem',['item_id' => $item->item_id]) ?>">Remove</a></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
			<?php endif;?>
			<tr>
				<td align="center" colspan="6">
					<button type="button" id="showProduct">New Item</button>
					<input type="submit" value="Update Item">
				</td>
			</tr>
		</table>
	</form>

	<form action="<?php echo $this->getUrl('cart','placeOrder') ?>" method="post">
		<table border="1">
			<tr>
				<td>Sub Total</td>
				<td><?php echo $this->getTotal(); ?></td>
			</tr>
			<tr>
				<td>Shiping Charge</td>
				<td><?php echo $cart->cart->shipingCharge; ?></td>
			</tr>

			<tr>
				<td>Tax</td>
				<td><?php echo $this->getTax($cart->cart->cart_id); ?></td>
				<input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cart->cart_id); ?>">
			</tr>

			<tr>
				<td>Discount</td>
				<td><?php echo $cart->cart->discount; ?></td>
				<input type="hidden" name="discount" value="<?php echo $cart->cart->discount; ?>">
			</tr>

			<tr>
				<td>Grand Total</td>
				<td><?php echo $this->getTotal() + ($cart->cart->shippingCharge) + $this->getTax($cart->cart->cartId) - $cart->cart->discount; ?></td>

				<input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + ($cart->cart->shippingCharge) + $this->getTax($cart->cart->cartId) - $cart->cart->discount; ?>">
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" <?php echo $disabled; ?> value="Place Order"></td>
			</tr>
		</table>
	</form>

<script type="text/javascript">
	function change(val) 
	{
		window.location = "<?php echo $this->getUrl(null,'addCart',['id'=>null]);?>&id="+val;
	}
</script>
<script type="text/javascript">
	function change(val) 
	{
		window.location = "<?php echo $this->getUrl(null,'addCart',['id'=>null]);?>&id="+val;
	}

	function same() {
					var checkedBox = document.getElementById("hardik");
					if(checkedBox.checked == true){
						var firstName = document.getElementById("firstName").value;
						var lastName = document.getElementById("lastName").value;
						var address = document.getElementById("address").value;
						var city = document.getElementById("city").value;
						var state = document.getElementById("state").value;
						var postalCode = document.getElementById("postalCode").value;
						var country = document.getElementById("country").value;

						document.getElementById("firstName1").value = firstName; 
						document.getElementById("lastName1").value = lastName; 
						document.getElementById("address1").value = address; 
						document.getElementById("city1").value = city; 
						document.getElementById("state1").value = state; 
						document.getElementById("postalCode1").value = postalCode; 
						document.getElementById("country1").value = country; 
					}
					else{
						document.getElementById("firstName1").value = null; 
						document.getElementById("lastName1").value = null; 
						document.getElementById("address1").value = null; 
						document.getElementById("city1").value = null; 
						document.getElementById("state1").value = null; 
						document.getElementById("postalCode1").value = null; 
						document.getElementById("country1").value = null; 
					}
                }

</script>
<script>
    $(document).ready(function(){
        $("#productTable").hide();
        $("#showProduct").click(function(){
            $("#productTable").show();
        });
        $("#hideProduct").click(function(){
            $("#productTable").hide();
        });
    });
</script>