<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Order extends Controller_Admin_Action{

	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
        }
    }

	public function gridAction()
	{
		/*$this->setTitle('Admin');
		$content = $this->getLayout()->getContent();
		$orderGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($orderGrid,'grid');
		$this->randerLayout();*/
	}

	public function editAction()
	{
		try {
			$orderModel = Ccc::getModel("Order");
			$request = $this->getRequest();
			$orderId = $request->getRequest('id');
			if(!(int)$orderId){
				$this->getMessage()->addMessage('Id Not Found',3);
				throw new Exception('Invalid Request', 1);			
			}
			$order = $orderModel->load($orderId);

			if(!$order){
				$this->getMessage()->addMessage('Data Not Load',3);
				throw new Exception('Invalid Request', 1);
			}
			
			$content = $this->getLayout()->getContent();
			$bilingAddress = $order->getBillingAddress();
			$shipingAddress = $order->getShippingAddress();
			$items = $order->getItems();

			
			$orderEdit = Ccc::getBlock('Cart_Order_Edit')->setData(['order' => $order]);

			$content->addChild($orderEdit,'edit');
			$this->randerLayout();
	
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			//$this->redirect('order','grid',[],true);
		}
	}
}

?>