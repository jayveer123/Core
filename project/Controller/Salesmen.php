<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Salesmen extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
        }
    }
    
	public function gridAction()
	{	
		$this->setTitle('Salesmen');
		$content = $this->getLayout()->getContent();
        $salesmenGrid = Ccc::getBlock('Salesmen_Grid');
        $content->addChild($salesmenGrid,'grid');
        $this->randerLayout();
	}
	public function addAction()
	{
		$this->setTitle('Salesmen Add');
		$salesmenModel = Ccc::getModel('Salesmen');
		$salesmen = $salesmenModel;

		$content = $this->getLayout()->getContent();
        $salesmenAdd = Ccc::getBlock('Salesmen_Edit')->setData(['salesmen'=>$salesmen]);
        $content->addChild($salesmenAdd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
			$this->setTitle('Salesmen  Edit');
			$salesmenModel = Ccc::getModel('Salesmen');
			$salesmen = $salesmenModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$salesmenData = $salesmen->load($id);
			if(!$salesmenData)
			{
				$this->getMessage()->addMessage('Unable To Find Data',3);
			}

			$content = $this->getLayout()->getContent();
	        $salesmenEdit = Ccc::getBlock('Salesmen_Edit')->addData('salesmen',$salesmenData);
	        $content->addChild($salesmenEdit,'add');
	        $this->randerLayout();
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

			
			foreach($customers as $customer){

				$customerPrices = $customerPriceModel->fetchAll("SELECT `id` FROM `customer_price` WHERE `customer_id` = {$customer->id}");
				foreach ($customerPrices as $customerPrice) {
					$customerPriceModel->load($customerPrice->id)->delete();
				}
			}

			$salesmen = $salesmenModel;
			$result = $salesmen->load($id);
			if (!$result) {
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Deleted Successfully',1);
			$this->redirect('salesmen','grid',[],true);
			
		} catch (Exception $e) {
			echo "<pre>";
			print_r($e);
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

			if(empty($id)){
				
				$salesmen->createdDate = date('Y-m-d H:m:s');
				
				unset($salesmen->id);	
				$insert = $salesmen->save();
				
				if(!$insert)
				{
					$this->getMessage()->addMessage('Data Not Inserted',3);
				}
				$this->getMessage()->addMessage('Data Inserted Successfully',1);
			}
			else
			{
				if(!(int)$id)
				{
					throw new Exception("Invalid Request.", 1);
				}

				$salesmen->id = $id;
				$salesmen->updatedDate  = date('Y-m-d H:m:s');

				$update = $salesmen->save();

				if (!$update) {
					$this->getMessage()->addMessage('Data Not Updated',3);
				}
				$this->getMessage()->addMessage('Data Updated Successfully',1);

			}
			$this->redirect('salesmen','grid',[],true);

		} catch (Exception $e) {
			echo "<pre>";
			print_r($e);
		}
	}
	public function errorAction()
	{
		echo "error";
	}
	


}


?>