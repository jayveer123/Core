<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Salesmen_SalesmenCustomer extends Controller_Admin_Action{

    public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    public function gridBlockAction()
    {
        
        $customerManageGrid = Ccc::getBlock('Salesmen_SalesmenCustomer_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $customerManageGrid
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
    }

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
            $this->gridBlockAction();
        }
    }
}

?>