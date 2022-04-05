<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Salesmen extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    public function indexAction()
	{
		$this->setTitle("Salesmen");
		$content = $this->getLayout()->getContent();
		$salesmenIndex = Ccc::getBlock('Salesmen_Index');
		$content->addChild($salesmenIndex);
		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		
		$salesmenGrid = Ccc::getBlock('Salesmen_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmenGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}
	public function addBlockAction()
	{
		$salesmenModel = Ccc::getModel("Salesmen");
		$salesmen = $salesmenModel;

		Ccc::register('salesmen',$salesmen);

		$salesmenEdit = Ccc::getBlock('Salesmen_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmenEdit
				],
				[
					'element' => '#salesmenMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
		
	}
	public function editBlockAction()
	{
		try 
   		{
   			$salesmenModel = Ccc::getModel('Salesmen');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$salesmen = $salesmenModel->load($id);
			if(!$salesmen)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			$this->setTitle('Salesmen Edit');
			Ccc::register('salesmen',$salesmen);

			$salesmenEdit = Ccc::getBlock('Salesmen_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmenEdit
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
   		}	 
   		catch (Exception $e) 
   		{
   			throw new Exception("Invalid Request.", 1);
   		}
   	}

	public function deleteAction()
	{
		try {
			$salesmenModel = Ccc::getModel('Salesmen');
			$customerModel = Ccc::getModel('Customer');
			$customerPriceModel = Ccc::getModel('Customer_Price');

			$request = $this->getRequest();

			if (!$request->getRequest('id')) {
				throw new Exception("Id not Found", 1);
			}

			$id = $request->getRequest('id');


			$customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmen_id` = {$id}");

			if($customers){
				foreach($customers as $customer){

					$customerPrices = $customerPriceModel->fetchAll("SELECT `id` FROM `customer_price` WHERE `customer_id` = {$customer->id}");

					if ($customerPrices) {
						foreach ($customerPrices as $customerPrice) {
							$customerPriceModel->load($customerPrice->id)->delete();
						}
					}
				}
			}

			$salesmen = $salesmenModel;
			$result = $salesmen->load($id);
			if (!$result) {
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Deleted Successfully',1);
			$this->gridBlockAction();
			
		} catch (Exception $e) {
			$this->gridBlockAction();
		}
	}
	public function saveAction()
	{
		try {
			date_default_timezone_set("Asia/Kolkata");

			$salesmenModel = Ccc::getModel('Salesmen');
			$request = $this->getRequest();

			if (!$request->getPost('salesmen')) {
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$postData = $request->getPost('salesmen');

			if(!$postData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}

			$id = $request->getRequest('id');

			$salesmen = $salesmenModel;
			$salesmen->setdata($postData);

			if(!$salesmen->id)
			{
				unset($salesmen->id);
				$salesmen->createdDate = date("Y-m-d h:i:s");
			}
			else
			{
				$salesmen->updatedDate = date("Y-m-d h:i:s");
			}
			$insert = $salesmen->save();
			if(!$insert)
			{
				$this->getMessage()->addMessage('unable to insert Salesmen.',3);
				throw new Exception("Unable to Save Record.", 1);
				
			}
			$this->getMessage()->addMessage('Salesman Inserted succesfully.',1); 
				$this->gridBlockAction();

		} catch (Exception $e) {
			$this->gridBlockAction();
		}
	}


}


?>