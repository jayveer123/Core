<?php Ccc::loadClass('Controller_Core_Action'); ?>


<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php
class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function saveCustomer()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->getPost('customer'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('customer');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}
		$customer = $customerModel;
		$customer->setData($postData);

		if($customer->id==null)
		{
			unset($customer->id);
			$customer->createdDate = date('y-m-d h:m:s');
			$insert = $customer->save();
			if($insert==null)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}
		else
		{
			if(!(int)$customer->id)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customer->updatedDate = date('y-m-d h:i:s');
			$update = $customer->save();
		}	 
	}
	protected function saveAddress($customerId)
	{		
		$addressModel = Ccc::getModel('Customer_Address');
		$request = $this->getRequest();
		if(!$request->getPost('address'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}
		$address = $addressModel;
		$address->setData($postData);

		if($address->address_id == null)
		{	
			$address->customer_id = $customerId;
			unset($address->address_id);
			$insert = $address->save();
			if(!$insert)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
		}
		else
		{
			$address->billing = (!array_key_exists('billing',$postData))?2:1;
			$address->shipping = (!array_key_exists('shipping',$postData))?2:1;
			$update = $address->save();
			if(!$update)
			{
				throw new Exception("System is unable to Update.", 1);
			}
		}
	}
	public function saveAction()
	{
		error_reporting(0);

		try{
			$customerId=$this->saveCustomer();
			$request = $this->getRequest();

			if(!$request->getPost('address'))
			{
				$this->redirect($this->getView()->getUrl('customer','grid',[],true));
			}

			$this->saveAddress($customerId);

			$this->redirect($this->getView()->getUrl('customer','grid',[],true));
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
		
	}

	public function editAction()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		$id = (int)$request->getRequest('id');
		if(!$id)
		{
			throw new Exception("Invalid Request", 1);
		}
		
		$customer=$customerModel->load($id);
		
		if(!$customer)
		{	
			throw new Exception("System is unable to find record.", 1);	
		}
		$addressModel = Ccc::getModel('Customer_Address');
		$address = $addressModel->load($id,'customer_id');
		if(!$address)
		{
			$address = ['customer_id' => $customer['customer_id']];	
		}
		Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address)->toHtml();
	}

	public function addAction()
	{
		$customerModel = Ccc::getModel('Customer');	
		$addressModel = Ccc::getModel('Customer_Address');	
		Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel])->toHtml();
	}

	public function deleteAction()
	{
		try{
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$customerId = $request->getRequest('id');

			if(!$customerId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$customer = $customerModel;

			$result = $customer->load($customerId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
		    $this->redirect($this->getView()->getUrl('customer','grid',[],true));
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

	public function redirect($url)
	{
		header("location:$url");
		exit();
	}


}


?>