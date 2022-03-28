<?php

class Model_Core_Cart
{

	protected $session = null;

	public function __construct()
	{

	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession();
		}
		return $this->session;
	}

	public function setSession($session = null)
	{

		if(!$session)
		{
			$session = 'Core_Session';
		}
		$this->session = Ccc::getModel($session);
		return $this->session;
	}


	public function getCart()
	{
		$this->getSession();
		if(!$this->getSession()->cart)
		{
			return null;
		}
		return $this->getSession()->cart;
	}

	public function unsetSession()
	{
	
		if(!$this->getSession()->messages)
		{
			return null;
		}
		unset($this->getSession()->messages);
	}
	public function unsetCart()
	{
		$this->getSession()->start();
		if(!$this->getSession()->cart)
		{
            return null;
        }
		unset($this->getSession()->cart);
		return $this;
	}
	public function addCart($cartId)
	{
		$cart['cart_id'] = $cartId;
		$this->getSession()->cart = $cart;
		return $this;
	}

}





 ?>