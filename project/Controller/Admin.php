<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Admin extends Controller_Admin_Action{
	
	public function __construct()
    {
    	
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
        }
    }

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'grid');
		$this->randerLayout();
	}

	public function saveAction()
	{
		error_reporting(0);

		try{

			$adminModel = Ccc::getModel('Admin');

			$request = $this->getRequest();

			if(!$request->getPost('admin'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}	

			$postData = $request->getPost('admin');

			if(!$postData)
			{
				$this->getMessage()->addMessage('Invalid Request For Data',3);
			}
			$admin = $adminModel;
			$admin->setdata($postData);

			if (!($admin->id)) {
				unset($admin->id);
				date_default_timezone_set("Asia/Kolkata");
				$admin->createdDate = date('Y-m-d H:m:s');
					
			}
			else{
				
				if(!(int)$postData['id'])
				{
					$this->getMessage()->addMessage('Id Not Found',3);
				}
				$admin->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$admin->updatedDate  = date('Y-m-d H:m:s');	
			}
			$admin->password = md5($postData['password']);
			$result=$admin->save();
			
			if(!$result)
			{
				$this->getMessage()->addMessage('Record Not Saved.',3);
			}

		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
		$this->getMessage()->addMessage('Record Saved.',1);
		$this->redirect('admin','grid',[],true);
	}
	public function addAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;

		$content = $this->getLayout()->getContent();
		$adminAdd = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
		$content->addChild($adminAdd,'add');
		$this->randerLayout();
	}

	public function editAction()
	{
			$adminModel = Ccc::getModel('Admin');
			$admin = $adminModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$adminData = $admin->load($id);
			if(!$adminData)
			{
				$this->getMessage()->addMessage('Admin Data Cant Find',3);
			}

			$content = $this->getLayout()->getContent();
			$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$adminData]);
			$content->addChild($adminEdit,'edit');
			$this->randerLayout();
	}
	public function deleteAction()
	{
		try{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$adminId = $request->getRequest('id');

			if(!$adminId)
			{
				$this->getMessage()->addMessage('Admin Id Not Found',3);
			}
			$admin = $adminModel;

			$result = $admin->load($adminId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 3);
			}
			$this->getMessage()->addMessage('Admin Data Delted Sucess',1);
		    
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
		$this->redirect('admin','grid',[],true);
		
	}

	public function errorAction()
	{
		echo "error";
	}
	


}


?>