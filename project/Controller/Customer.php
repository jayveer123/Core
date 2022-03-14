<?php Ccc::loadClass('Controller_Admin_Action'); ?>


<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php
class Controller_Customer extends Controller_Admin_Action{

	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
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
		return $customer->id;
	}
	protected function saveAddress($customerId)
	{	
		$addressModel = Ccc::getModel('Customer_Address');
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
		if($address->address_id == null)
		{	
			$address->customer_id = $customerId;
			unset($address->address_id);
			
		}
		else
		{
			$address->billing = (!array_key_exists('billing',$postData))?2:1;
			$address->shipping = (!array_key_exists('shipping',$postData))?2:1;
		}
		$result = $address->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('address Not Updated',3);;
		}
		$this->getMessage()->addMessage('Address Updated Successfully',1);
	}
	public function saveAction()
	{
		error_reporting(0);
		try{
			$request = $this->getRequest();
			$customerId=$this->saveCustomer();
			
			if(!$customerId){
				$this->getMessage()->addMessage('Your data notinserted', 3);
			}	
			if(!empty($request->getPost('address'))){

				$result = $this->saveAddress($customerId);
			}
			$this->redirect('customer','grid',[],true);
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
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
        $customerEdit = Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address);
        $content->addChild($customerEdit,'edit');
        $this->randerLayout();
	}

	public function addAction()
	{
		$this->setTitle('Customer Add');
		$customerModel = Ccc::getModel('Customer');	
		$addressModel = Ccc::getModel('Customer_Address');	

		$content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel]);
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
		    $this->redirect('customer','grid',[],true);
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