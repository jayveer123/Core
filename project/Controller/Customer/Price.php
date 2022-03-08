<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
		$content->addChild($customerPriceGrid,'grid');

		$this->randerLayout();
	}

	public function saveAction()
	{
		try {
				$customerPriceModel = Ccc::getModel('Customer_Price');
				$request = $this->getRequest();
				$customerId = $request->getRequest('id');
				if($request->isPost()){
					$customers = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `customer_id` = '$customerId'");
					if($customers){
						foreach($customers as $customer){
							$customerPriceModel->load($customer->customer_id,'customer_id')->delete();
						}
					}
					$customerData = $request->getPost('product');
					$customerPriceModel->customer_id = $customerId;
					foreach($customerData as $customer){

						$minimunPrize = (float)$customer['mrp'] - (float)$customer['mrp']*(float)$customer['discount']/100;

						if($minimunPrize >= (float)$customer['msp']){
							$customerPriceModel->discount = $customer['discount'];
						}
						else{
							$customerPriceModel->discount = 100 - (float)$customer['msp']*100/(float)$customer['mrp'];
						}
						$customerPriceModel->product_id = $customer['product_id'];
						$customerPriceModel->save();
					}
				}
				$this->getMessage()->addMessage('Discount Give Successfully',1);

				$this->redirect($this->getView()->getUrl('customer_price','grid',['id' => $customerId],true));

			} catch (Exception $e) {
				$this->redirect($this->getView()->getUrl('customer_price','grid',['id' => $customerId],true));
			}
	}
}

?>