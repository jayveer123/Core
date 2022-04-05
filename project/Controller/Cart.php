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
	public function indexAction()
    {
        $this->setTitle('Cart');
        $content = $this->getLayout()->getContent();
        $cartIndex = Ccc::getBlock('Cart_Index');
        $content->addChild($cartIndex);
        $this->randerLayout();
    }
    public function indexBlockAction()
    {
        $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
        $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartAddress',
                    'content' => $cartEditAddress,
                ],
                [
                    'element' => '#paymentShipping',
                    'content' => $cartEditPaymentShipping,
                ],
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
    }

	public function gridBlockAction()
    {
        $this->getCart()->unsetCart();
        $cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartGrid,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
    }

	public function editBlockAction()
    {
        $cartEdit = Ccc::getBlock('Cart_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartEdit,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
    }

    public function addCartAction()
    {
        try
        {
            if($this->getCart()->getCart())
            {
                $this->editBlockAction();
            }
            else
            {
                $cartModel = Ccc::getModel('Cart');
                $request = $this->getRequest();
                $customerId = (int)$request->getRequest('id');
                
                $cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
                if($cart)
                {
                    $this->getCart()->addCart($cart->cart_id);
                }
                else
                {
                    $cartModel->customer_id = $customerId;
                    $cartModel->paymentMethod = 4;
                    $cartModel->shippingMethod = 3;
                    $cartModel->shippingCharge = 50;
                    $cart = $cartModel->save();
                    if(!$cart)
                    {
                        throw new Exception("Unable to save cart.");
                    }
                    $this->saveAddressAction($cart);
                    $this->getCart()->addCart($cart->cart_id);
                }
                $this->getMessage()->addMessage('Cart loaded.');
                $this->editBlockAction();
            }
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
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
				$bilingAddress = $cart->getBillingAddress();
				$bilingAddress->cart_id = $cart->cart_id;
				$bilingAddress->firstName = $customer->firstName;
				$bilingAddress->lastName = $customer->lastName;
				$bilingAddress->setData($customerBilingAddress->getData());
				unset($bilingAddress->address_id);
				unset($bilingAddress->customer_id);
				
				$bilingAddress->save();
				if(!$bilingAddress)
                {
                    throw new Exception("Biling address not saved.");
                }
			}
			if($customerShipingAddress){
				$shipingAddress = $cart->getShippingAddress();
				$shipingAddress->cart_id = $cart->cart_id;
				$shipingAddress->firstName = $customer->firstName;
				$shipingAddress->lastName = $customer->lastName;
				$shipingAddress->setData($customerShipingAddress->getData());
				unset($shipingAddress->address_id);
				unset($shipingAddress->customer_id);
				$shipingAddress->save();
				if(!$shipingAddress)
                {
                    throw new Exception("Shiping address not saved.");
                }
			}
			$this->getMessage()->addMessage("Address Saved.");	
		}
		catch (Exveption $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
		}
	}

	public function saveCartAddressAction()
	{
		try{
			$request = $this->getRequest();

			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);

			$bilingData = $request->getPost('billingAddress');
			$shipingData = $request->getPost('shippingAddress');

			$bilingAddress = $cart->getBillingAddress();
			$shipingAddress = $cart->getShippingAddress();

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
			$this->getMessage()->addMessage("Address Saved.");

			$cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
	            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
	            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
	            $response = [
	                'status' => 'success',
	                'elements' => [
	                    [
	                        'element' => '#cartAddress',
	                        'content' => $cartEditAddress,
	                    ],
	                    [
	                        'element' => '#cartSubTotal',
	                        'content' => $cartEditSubTotal,
	                    ],
	                    [
	                        'element' => '#adminMessage',
	                        'content' => $messageBlock
	                    ]
	                ]
	            ];
	            $this->randerJson($response);
	    }catch (Exception $e){
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
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
		
		$cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#paymentShiping',
                        'content' => $cartEditPaymentShipping,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->randerJson($response);
	}
	public function saveShippingMethodAction()
	{

		$request = $this->getRequest();
		
		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$shippingMethod = $request->getPost('shippingMethod');
		if($shippingMethod == 1){
			$shippingCharge = '100';
		}
		elseif($shippingMethod == 2){
			$shippingCharge = '70';
		}
		else{
			$shippingCharge = '50';
		}
		$cart->setData(['shippingMethod' => $shippingMethod, 'shippingCharge' => $shippingCharge]);
		$cart->save();

		$cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartAddress',
                    'content' => $cartEditAddress,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
	}

	public function addCartItemAction()
	{
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		
		$cartId = $this->getCart()->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->load($cartId);

		$item = Ccc::getModel('Cart_Item');

		$taxAmount = null;
        $discount = null;
        $cartData = $request->getPost('cartProduct');
        $item->cart_id = $cart->cart_id;

        if(!$cartId)
        {
            throw new Exception("Request Invalid.");
        }

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
		$cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],      
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
	}
	public function deleteCartItemAction()
	{
		$request = $this->getRequest();
        $itemId = $request->getRequest('id');
        
        $item = Ccc::getModel('Cart_Item')->load($itemId);
        $cart = $item->getCart();
        
        $cart->subtotal = $cart->subtotal - $item->itemTotal;
        $cart->taxAmount = $cart->taxAmount - $item->taxAmount;
        $cart->discount = $cart->discount - $item->discount;

        $cartSave = $cart->save();
        if(!$cartSave)
        {
            throw new Exception("Not Saved", 1);
        }
        $result = $item->delete();

        if(!$result)
        {
            throw new Exception("Item not deleted.");
        }
        $this->getMessage()->addMessage("Item Deleted.");
        $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
	}

	public function cartItemUpdateAction()
	{
		$taxAmount = null;
        $discount = null;
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
		
		$cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],      
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
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
		$orderModel->shippingId = $cart->shippingMethod;
		$orderModel->shippingCharge = $cart->shippingCharge;
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
		}
		$addressModel = Ccc::getModel('Order_Address');
		$bilingData = $cart->getBillingAddress();
		$shipingData = $cart->getShippingAddress();
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

		
		
		$this->gridBlockAction();
	}


}

?>