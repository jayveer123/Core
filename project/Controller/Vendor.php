<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Vendor extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    
	public function indexAction()
	{
		$this->setTitle("Vendor");
		$content = $this->getLayout()->getContent();
		$vendorIndex = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorIndex);
		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorGrid
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
		$vendorModel = Ccc::getModel("Vendor");
		$vendor = $vendorModel;
		$address = $vendorModel;

		Ccc::register('vendor',$vendor);
		Ccc::register('address',$address);

		$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorEdit
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
		try 
		{
			$vendorModel = Ccc::getModel("Vendor");
			$addressModel = Ccc::getModel("Vendor_Address");
			$request = $this->getRequest();
			$vendorId = $request->getRequest('id');
			if(!(int)$vendorId)
			{
				throw new Exception("Error Processing Request", 1);			
			}
			$vendor = $vendorModel->load($vendorId);
			$address = $vendor->getAddress();
			if(!$vendor)
			{
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('vendor',$vendor);
			Ccc::register('address',$address);

			$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $vendorEdit
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
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}	
	}

	
	public function deleteAction()
	{
		try{
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$vendorId = $request->getRequest('id');

			if(!$vendorId)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$vendor = $vendorModel;

			$result = $vendor->load($vendorId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Delted Sucess',1);
		    $this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
	}
	public function saveVendor()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$request = $this->getRequest();
		if(!$request->getPost('vendor'))
		{
			$this->getMessage()->addMessage('Invalid Request',3);
		}	
		$postData = $request->getPost('vendor');
		if(!$postData)
		{
			$this->getMessage()->addMessage('Data No Found',3);
		}
		$vendor = $vendorModel;
		$vendor->setData($postData);

		if(!$vendor->id)
		{
			unset($vendor->id);
			$vendor->createdDate = date('y-m-d h:m:s');
		}
		else
		{
			if(!(int)$vendor->id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$vendor->updatedDate = date('y-m-d h:i:s');
		}
		$vendor = $vendorModel->save();
		if(!$vendor)
		{
			$this->getMessage()->addMessage('Data Not Inserted',3);
		}
		$this->getMessage()->addMessage('Data Inserted Successfully',1);
		return $vendor;	 
	}
	protected function saveAddress($vendor = null)
	{	
		if(!$vendor)
		{
			$vendorId = $this->getRequest()->getRequest('id');
			if(!$vendorId)
			{
				$this->getMessage()->addMessage('Vendor Not Inserted',3);
				throw new Exception("System is unable to Save Address without Vendor.", 1);
			}
			$vendor = Ccc::getModel('vendor')->load($vendorId);
		}
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Invalid Request", 1);
		}
		$postData = $request->getPost('address');

		$address = $vendor->getAddress();
		if(!$address->id)
		{
			unset($address->id);
		}
		if($postData)
		{
			$address->setData($postData);
		}
		$address->vendor_id=$vendor->id;

		if(!$address->id)
		{
			unset($address->id);
		}
	
		$save = $address->save();
		if(!$save)
		{
			$this->getMessage()->addMessage('Address Inserted succesfully.',1);
			throw new Exception("Unable to Save.", 1);
		}
	}
	public function saveAction()
	{

		try{
			if($this->getRequest()->getPost('vendor'))
			{
				$vendor = $this->saveVendor();
				
				if(!$vendor)
				{
					$this->getMessage()->addMessage('Your data not inserted', 3);
				}
				$this->saveAddress($vendor);
			}
			if ($this->getRequest()->getPost('address'))
			{
				$this->saveAddress();
			}

			$this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
	}
	public function errorAction()
	{
		echo "error";
	}
	


}


?>