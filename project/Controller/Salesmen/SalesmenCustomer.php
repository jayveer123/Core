<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Salesmen_SalesmenCustomer extends Controller_Core_Action{

	public function gridAction()
	{
        $this->setTitle('Customer Assign');
		$content = $this->getLayout()->getContent();
		$salesmenGrid = Ccc::getBlock("Salesmen_SalesmenCustomer_Grid");
		$content->addChild($salesmenGrid,'grid');
		
		$this->randerLayout();
	}
	public function saveAction()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        $salesmenId = $request->getRequest('id');

       
        if($request->isPost()){
            $customerData = $request->getPost('customer');

            $customerModel->salesmen_id = $salesmenId;

            foreach($customerData as $customer){
                $customerModel->id = $customer;
                $result = $customerModel->save(); 

                if(!$result){
                    $this->getMessage()->addMessage('Customer Not Assign',3);
                    throw new Exception("Error Processing Request", 1);
                }
            }
            $this->redirect('grid','salesmen_salesmenCustomer',['id' => $salesmenId],true);
			
        }
    }
}

?>