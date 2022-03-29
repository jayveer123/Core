<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Vendor extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    
	public function gridAction()
	{
		
		$this->setTitle('Vendor');
		$content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Grid');
        $content->addChild($vendorGrid,'grid');
        $this->randerLayout();
	}
	public function addAction()
	{
		
		$this->setTitle('Vendor Add');
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel;

		$content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor]);
        $content->addChild($vendorAdd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
		$this->setTitle('Vendor Edit');
		$vendorModel = Ccc::getModel('Vendor');
		$request = $this->getRequest();
		$id = (int)$request->getRequest('id');
		if(!$id)
		{
			$this->getMessage()->addMessage('Id Not Found',3);
		}
		
		$vendor=$vendorModel->load($id);
		
		if(!$vendor)
		{	
			$this->getMessage()->addMessage('Data Not Found',3);
		}
		$addressModel = Ccc::getModel('Vendor_Address');
		$address = $addressModel->load($id,'vendor_id');
		if(!$address)
		{
			$address = ['vendor_id' => $customer['vendor_id']];	
		}

		$content = $this->getLayout()->getContent();
        $vendorEdit = Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->addData('address',$address);
        $content->addChild($vendorEdit,'edit');
        $this->randerLayout();
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
		    $this->redirect('grid','vendor',[],true);
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
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
	protected function saveAddress($vendor)
	{	
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Invalid Request", 1);
		}
		$postData = $request->getPost('address');

		$address = $vendor->getAddress();
		
		$address->setData($postData);
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
			$vendor = $this->saveVendor();
			
			if(!$vendor)
			{
				$this->getMessage()->addMessage('Your data not inserted', 3);
			}
			$this->saveAddress($vendor);
			$this->redirect('grid','vendor',[],true);
		}
		catch(Exception $e){
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