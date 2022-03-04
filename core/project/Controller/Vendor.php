<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Vendor extends Controller_Core_Action{
	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Grid');
        $content->addChild($vendorGrid,'grid');
        $this->randerLayout();
	}
	public function addAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel;

		$content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor]);
        $content->addChild($vendorAdd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
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

			$result = $vendor->load($vendorId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}

			$this->getMessage()->addMessage('Data Delted Sucess',1);
		    $this->redirect($this->getView()->getUrl('vendor','grid',[],true));
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

		if($vendor->id==null)
		{
			unset($vendor->id);
			$vendor->createdDate = date('y-m-d h:m:s');
			$insert = $vendor->save();
			if($insert==null)
			{
				$this->getMessage()->addMessage('Data Not Inserted',3);
			}

			$this->getMessage()->addMessage('Data Inserted Successfully',1);
			return $insert;
		}
		else
		{
			if(!(int)$vendor->id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$vendor->updatedDate = date('y-m-d h:i:s');
			$update = $vendor->save();

			$this->getMessage()->addMessage('Data Update Succsesfully',1);
		}	 
	}
	protected function saveAddress($vendorId)
	{	

		$addressModel = Ccc::getModel('Vendor_Address');
		$request = $this->getRequest();
		if(!$request->getPost('address'))
		{
			$this->getMessage()->addMessage('Invalid Request',3);
		}	
		$postData = $request->getPost('address');
		if(!$postData)
		{
			$this->getMessage()->addMessage('Data Not Found',3);
		}
		$address = $addressModel;
		$address->setData($postData);

		if($address->id == null)
		{	
			$address->vendor_id = $vendorId;
			unset($address->id);
			$insert = $address->save();
			if(!$insert)
			{
				$this->getMessage()->addMessage('Data Not Inserted',3);
			}
			$this->getMessage()->addMessage('Data Inserted Successfully',1);
		}
		else
		{
			$address->billing = (!array_key_exists('billing',$postData))?2:1;
			$address->shipping = (!array_key_exists('shipping',$postData))?2:1;
			$update = $address->save();
			if(!$update)
			{
				$this->getMessage()->addMessage('Data Not Updated',3);
			}
			$this->getMessage()->addMessage('Data Updated Successfully',1);
		}
	}
	public function saveAction()
	{
		error_reporting(0);

		try{
			$vendorId=$this->saveVendor();
			$request = $this->getRequest();

			if(!$request->getPost('address'))
			{
				$this->redirect($this->getView()->getUrl('vendor','grid',[],true));
			}

			$this->saveAddress($vendorId);
			

			$this->redirect($this->getView()->getUrl('vendor','grid',[],true));
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