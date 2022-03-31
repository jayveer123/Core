<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action{

	/*public function gridAction()
	{
		$this->setTitle('Customer Price');
		$content = $this->getLayout()->getContent();
		$customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
		$content->addChild($customerPriceGrid,'grid');

		$this->randerLayout();
	}*/
	public function gridBlockAction()
	{
		
		$customerGrid = Ccc::getBlock('Customer_Price_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
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
						
						
						if($customer['salesmenPrice'] <= $customer['discount']){
							$customerPriceModel->discount = $customer['discount'];
						}
						else{
							$customerPriceModel->discount = $customer['salesmenPrice'];
						}

						if($customer['discount']){
							$customerPriceModel->product_id = $customer['product_id'];
							$customerPriceModel->save();
							unset($customerPriceModel->id);
						}
						
					}
				}
				$this->getMessage()->addMessage('Discount Give Successfully',1);
				$this->gridBlockAction();
				//$this->redirect('grid','customer_price',['id' => $customerId],true);

			} catch (Exception $e) {
				$this->getMessage()->addMessage('Invalid Request',3);
				$this->gridBlockAction();
			}
	}
}

?>