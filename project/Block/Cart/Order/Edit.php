<?php
Ccc::loadClass('Block_Core_Template');
class Block_Cart_Order_Edit extends Block_Core_Template   
{ 
	public function __construct()
	{
		$this->setTemplate('view/cart/order/edit.php');
	}
	
	 public function getOrder()
    {
        return Ccc::getRegistry('order');
    }
}
?>