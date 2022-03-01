<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Vendor extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}
	public function addAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel;
		Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor])->toHtml();
	}

	public function editAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$request = $this->getRequest();
		$id = (int)$request->getRequest('id');
		if(!$id)
		{
			throw new Exception("Invalid Request", 1);
		}
		
		$vendor=$vendorModel->load($id);
		
		if(!$vendor)
		{	
			throw new Exception("System is unable to find record.", 1);	
		}
		/*$addressModel = Ccc::getModel('Customer_Address');
		$address = $addressModel->load($id,'customer_id');
		if(!$address)
		{
			$address = ['customer_id' => $customer['customer_id']];	
		}*/
		Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->toHtml();
	}
	public function deleteAction()
	{
		try{
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$vendorId = $request->getRequest('id');

			if(!$vendorId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$vendor = $vendorModel;

			$result = $vendor->load($vendorId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
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
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('vendor');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
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
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}
		else
		{
			if(!(int)$vendor->id)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$vendor->updatedDate = date('y-m-d h:i:s');
			$update = $vendor->save();
		}	 
	}
	public function saveAction()
	{
		error_reporting(0);

		try{
			$vendorId=$this->saveVendor();
			

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