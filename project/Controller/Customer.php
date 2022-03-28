<?php Ccc::loadClass('Controller_Admin_Action'); ?>


<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php
class Controller_Customer extends Controller_Admin_Action{

	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    
	public function gridAction()
	{
		$this->setTitle('Customer');
		$content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock('Customer_Grid');
        $content->addChild($customerGrid,'grid');
        $this->randerLayout();

	}

	public function saveCustomer()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->getPost('customer'))
		{
			$this->getMessage()->addMessage('Invelid Request',3);
		}	
		$postData = $request->getPost('customer');
		if(!$postData)
		{
			$this->getMessage()->addMessage('Invalid Data Posted',3);
		}
		$customer = $customerModel;
		
		$customer->setData($postData);

		if(!$customer->id)
		{
			unset($customer->id);
			$customer->createdDate = date('y-m-d h:m:s');
		}
		else
		{
			if(!(int)$customer->id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$customer->updatedDate = date('y-m-d h:i:s');
		}
		$customer = $customerModel->save();
		if(!$customer){
			$this->getMessage()->addMessage('Your data not saved', 3);
		}
		$this->getMessage()->addMessage('Your Data Save Successfully');
		return $customer;
	}
	protected function saveAddress($customer = null)
	{
		try{
			if(!$customer)
			{
				$customerId = $this->getRequest()->getRequest('id');
				if(!$customerId){
					$this->getMessage()->addMessage('Your data not inserted', 3);
					throw new Exception("System is unable to Save.", 1);
				}	
				$customer = Ccc::getModel('customer')->load($customerId);
			}
			$request = $this->getRequest();
			if(!$request->getPost())
			{
				throw new Exception("Invalid Request", 1);
			}	
			$postBillingData = $request->getPost('billingaddress');
			$postShippingData = $request->getPost('shippingaddress');
			
			$billing = $customer->getBillingAddress();
			$shipping = $customer->getShippingAddress();

			if(!$billing->address_id)
			{
				unset($billing->address_id);
			}
			if(!$shipping->address_id)
			{
				unset($shipping->address_id);
			}

			if($postBillingData)
			{
				$billing->setData($postBillingData);
			}
			else
			{	
				$billing->billing = 1;
				$billing->shipping = 2;
			}
			$billing->customer_id = $customer->id;

			if($postShippingData)
			{
				$shipping->setData($postShippingData);	
			}
			else
			{
				$shipping->shipping = 1;
				$shipping->billing = 2;
			}
			$shipping->customer_id = $customer->id;
			

			
			$save = $billing->save();
			if(!$save)
			{
				$this->getMessage()->addMessage('Billing Address Not Saved.',3);
				throw new Exception("System is unable to Save.", 1);
			}
			$save = $shipping->save();
			if(!$save)
			{
				$this->getMessage()->addMessage('Shipping Address Not Saved.',3);
				throw new Exception("System is unable to Save.", 1);
			}
		}
		catch(Exception $e){
			$this->redirect('grid','customer',[],true);
		}
	}
	public function saveAction()
	{
		
		try{
			if($this->getRequest()->getPost('customer'))
			{
				//$request = $this->getRequest();
				$customer=$this->saveCustomer();
				
				if(!$customer){
					$this->getMessage()->addMessage('Your data notinserted', 3);
					throw new Exception("System is unable to Save.", 1);
				}
				$this->saveAddress($customer);
			}
			if ($this->getRequest()->getPost('billingaddress') || $this->getRequest()->getPost('shippingaddress'))
			{
				$this->saveAddress();			
			}	

			$this->redirect('grid','customer',[],true);
		}
		catch(Exception $e){
			$this->redirect('grid','customer',[],true);
		}
		
	}

	public function editAction()
	{
		$this->setTitle('Customer Edit');
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		$id = (int)$request->getRequest('id');
		if(!$id)
		{
			$this->getMessage()->addMessage('Id Not Found',3);
		}
		
		$customer=$customerModel->load($id);
		
		if(!$customer)
		{	
			$this->getMessage()->addMessage('Unable To find record',3);
		}
		$addressModel = Ccc::getModel('Customer_Address');
		$address = $addressModel->load($id,'customer_id');
		if(!$address)
		{
			$address = ['customer_id' => $customer['customer_id']];	
		}

		$content = $this->getLayout()->getContent();
        $customerEdit = Ccc::getBlock('Customer_Edit');
        Ccc::register('customer',$customer);
        Ccc::register('billingAddress',$customer->getBillingAddress());
        Ccc::register('shippingAddress',$customer->getShippingAddress());
        $content->addChild($customerEdit,'edit');
        $this->randerLayout();
	}

	public function addAction()
	{
		$this->setTitle('Customer Add');
		$customerModel = Ccc::getModel('Customer');	
		$addressModel = Ccc::getModel('Customer_Address');	

		$content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit');
        Ccc::register('customer',$customerModel);
        Ccc::register('billingAddress',$customerModel->getBillingAddress());
        Ccc::register('shippingAddress',$customerModel->getShippingAddress());
        $content->addChild($customerAdd,'add');
        $this->randerLayout();

	}

	public function deleteAction()
	{
		try{
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$customerId = $request->getRequest('id');

			if(!$customerId)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$customer = $customerModel;

			$result = $customer->load($customerId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Deleted Successfully',1);
		    $this->redirect('grid','customer',[],true);
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