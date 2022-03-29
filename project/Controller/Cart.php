<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_cart extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('cart');
		if(!$this->authentication()){
			$this->redirect('admin_login','login');
		}
	}
	public function gridAction()
	{
		$this->getCart()->unsetCart();
		$this->setTitle('Cart');
		$content = $this->getLayout()->getContent();
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content->addChild($cartGrid,'grid');
		$this->randerLayout();
	}

	public function editAction()
	{
		$cartModel = Ccc::getModel('cart');
		$cart = $cartModel;

		$content = $this->getLayout()->getContent();
		$cartEdit = Ccc::getBlock('cart_Edit');
		$cart = $cartEdit->cart = $cart;
		$content->addChild($cartEdit);

		$this->randerLayout();
	}

	public function addCartAction()
	{
		try {
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			if($this->getCart()->getCart()){

				$this->redirect('edit','cart');
			}
			else{
				$cartModel = Ccc::getModel('Cart');
				$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
				if($cart){
					$this->getCart()->addCart($cart->cart_id);
					$this->redirect('edit','cart');
				}
				else{
					$cartModel->customer_id = $customerId;
					$cartModel->status = 1;
					$cart = $cartModel->save();
					if(!$cart){
						$this->getMessage()->addMessage('Cart not added');
					}
					$this->saveAddressAction($cart);
					$this->getCart()->addCart($cart->cart_id);
				}
				$this->redirect('edit','cart');
			}

		} catch (Exception $e) {
			$this->redirect('edit','cart');
		}
		
	}

	public function saveAddressAction($cart)
	{
		try {

			$request = $this->getRequest();

			$customer = $cart->getCustomer();
			$customerBilingAddress = $customer->getBillingAddress();
			$customerShipingAddress = $customer->getShippingAddress();

			if($customerBilingAddress){
				$bilingAddress = $cart->getBilingAddress();
				$bilingAddress->cart_id = $cart->cart_id;
				$bilingAddress->firstName = $customer->firstName;
				$bilingAddress->lastName = $customer->lastName;
				$bilingAddress->setData($customerBilingAddress->getData());
				unset($bilingAddress->address_id);
				unset($bilingAddress->customer_id);
				
				$bilingAddress->save();
			}
			if($customerShipingAddress){
				$shipingAddress = $cart->getShipingAddress();
				$shipingAddress->cart_id = $cart->cart_id;
				$shipingAddress->firstName = $customer->firstName;
				$shipingAddress->lastName = $customer->lastName;
				$shipingAddress->setData($customerShipingAddress->getData());
				unset($shipingAddress->address_id);
				unset($shipingAddress->customer_id);
				$shipingAddress->save();
			}		} catch (Exveption $e) {
			echo $e->message();
		}
	}

	public function saveCartAddressAction()
	{
		$request = $this->getRequest();

		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$bilingData = $request->getPost('bilingAddress');
		$shipingData = $request->getPost('shipingAddress');

		$bilingAddress = $cart->getBilingAddress();
		$shipingAddress = $cart->getShipingAddress();

		$bilingAddress->setData($bilingData);
		$shipingAddress->setData($shipingData);

		$bilingAddress->save();
		$shipingAddress->save();

		if($request->getPost('saveInBilingBook')){
			$customer = $cart->getCustomer();
			$customerBilingAddress = $customer->getBillingAddress();
			$customerBilingAddress->setData($bilingData);
			unset($customerBilingAddress->firstName);
			unset($customerBilingAddress->lastName);
			$customerBilingAddress->save();
		}
		if($request->getPost('saveInShipingBook')){
			$customer = $cart->getCustomer();
			$customerShipingAddress = $customer->getShippingAddress();
			$customerShipingAddress->setData($shipingData);
			unset($customerShipingAddress->firstName);
			unset($customerShipingAddress->lastName);
			$customerShipingAddress->save();
		}
		$this->redirect('edit','cart');
	}

	public function savePaymentMethodAction()
	{

		$request = $this->getRequest();

		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$paymentData = $request->getPost('paymentMethod');
		$cart->setData(['paymentMethod' => $paymentData]);
		$cart->save();
		$this->redirect('edit','cart');
	}
	public function saveShippingMethodAction()
	{

		$request = $this->getRequest();
		
		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$shipingCharge = $request->getPost('shippingMethod');
		if($shipingCharge == 100){
			$shipingMethod = '1';
		}
		elseif($shipingCharge == 50){
			$shipingMethod = '2';
		}
		else{
			$shipingMethod = '3';
		}
		$cart->setData(['shipingMethod' => $shipingMethod, 'shipingCharge' => $shipingCharge]);
		$cart->save();
		$this->redirect('edit','cart');
	}

	public function addCartItemAction()
	{
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		
		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$cartData = $request->getPost('cartItem');
		$item = $cart->getItem();
		$item->cart_id = $cart->cart_id;
		
		foreach($cartData as $cartItem){
			if(array_key_exists('product_id',$cartItem)){
				$product = $productModel->load($cartItem['product_id']);
				if($product->p_qun >= $cartItem['quntity']){

					unset($item->item_id);
					$item->setData($cartItem);
					$item->itemTotal = $product->p_price * $cartItem['quntity'];
					$item->tax = $product->tax;
					$item->taxAmount = ($product->p_price * $product->tax / 100) * $cartItem['quntity'];
					$item->discount = ($product->discount * $cartItem['quntity']);

					$item->save();

					$taxAmount += ($product->p_price * $product->tax / 100) * $cartItem['quntity'];
					$discount += $product->discount * $cartItem['quntity'];
					unset($item->item_id);
				}
			}
		}
		$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
        $cart->subTotal = $subTotal->subTotal;
        $cart->taxAmount += $taxAmount;
        $cart->discount += $discount;

        $result = $cart->save();
		$this->redirect('edit','cart');
	}
	public function deleteCartItemAction()
	{
		$request = $this->getRequest();
		$itemId = $request->getRequest('item_id');
		$item = Ccc::getModel('Cart_Item');
		$cart = Ccc::getModel('Cart');
		$result = $item->load($itemId);

		$cart = $cart->load($result->cart_id);
		$cart->subtotal = $cart->subtotal - $result->itemTotal;
		$cart->taxAmount = $cart->taxAmount - $result->taxAmount;
		$cart->discount = $cart->discount - $result->discount;

		$cartSave = $cart->save();
		if(!$cartSave){
			throw new Exception("Not Saved", 1);
		}
		$result->delete();

		if($result){
			$this->redirect(null,'edit',['item_id' => null]);
		}
		$this->redirect(null,'edit',['item_id' => null]);
	}

	public function cartItemUpdateAction()
	{

		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		
		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$cartData = $request->getPost('cartItem');
		$item = $cart->getItem();
		foreach($cartData as $cartItem){
			$product = $productModel->load($cartItem['product_id']);
			
			if($product->p_qun >= $cartItem['quntity']){
				
				$item->setData($cartItem);
				$item->itemTotal = $product->p_price * $cartItem['quntity'];
				$item->tax = $product->tax;
				$item->taxAmount = ($product->p_price * $product->tax / 100) * $cartItem['quntity'];
				$item->discount = $product->discount * $cartItem['quntity'];

				$taxAmount += ($product->p_price * $product->tax / 100) * $cartItem['quntity'];
				$discount += $product->discount * $cartItem['quntity'];
				$item->save();
			}
		}
		$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
        $cart->subTotal = $subTotal->subTotal;
        $cart->taxAmount = $taxAmount;
        $cart->discount = $discount;
        $result = $cart->save();
		$this->redirect('edit','cart');
	}
	public function placeOrderAction()
	{
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');

		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$customer = $cart->getCustomer();
		$orderModel = Ccc::getModel('order');
		
		$orderModel->customerId = $cart->customer_id;
		$orderModel->firstName = $customer->firstName;
		$orderModel->lastName = $customer->lastName;
		$orderModel->email = $customer->email;
		$orderModel->mobile = $customer->mobile;
		$orderModel->shippingId = $cart->shipingMethod;
		$orderModel->shippingCharge = $cart->shipingCharge;
		$orderModel->paymentId = $cart->paymentMethod;
		$orderModel->grandTotal = $request->getPost('grandTotal');
		$orderModel->taxAmount = $request->getPost('taxAmount');
		$orderModel->discount = $request->getPost('discount');

		$order = $orderModel->save();

		$items = $cart->getItems();
		foreach($items as $item){
			

			$product = $item->getProduct();
			$itemModel = Ccc::getModel('Order_Item');
			$itemModel->order_id = $order->order_id;
			$itemModel->product_id = $product->id;
			$itemModel->name = $product->p_name;
			$itemModel->sku = $product->sku;
			$itemModel->price = $item->itemTotal;
			$itemModel->tax = $product->tax;
			$itemModel->taxAmount = ($product->p_price * $product->tax / 100) * $item->quntity;
			$itemModel->quntity = $item->quntity;
			$itemModel->discount = $item->discount;
			$result = $itemModel->save();
			if($result){
				$item->delete();
			}
		}
		//exit();
		$addressModel = Ccc::getModel('Order_Address');
		$bilingData = $cart->getBilingAddress();
		$shipingData = $cart->getShipingAddress();
		$bilingAddress = $order->getBillingAddress();
		$shipingAddress = $order->getShippingAddress();

		unset($bilingData->cart_id);
		unset($bilingData->address_id);
		unset($shipingData->cart_id);
		unset($shipingData->address_id);

		$bilingAddress->setData($bilingData->getData());
		$bilingAddress->email = $customer->email;
		$bilingAddress->mobile = $customer->mobile;
		$bilingAddress->order_id = $order->order_id;

		$shipingAddress->setData($shipingData->getData());
		$shipingAddress->email = $customer->email;
		$shipingAddress->mobile = $customer->mobile;
		$shipingAddress->order_id = $order->order_id;

		

		$bilingResult = $bilingAddress->save();
		$shipinhResult = $shipingAddress->save();

		if($bilingResult){
			$bilingData->delete();
		}
		if($shipinhResult){
			$shipingData->delete();
		}
		if($order){
			$cart->delete();
		}
		
		$this->redirect('grid','cart',[],true);
	}


}

?>