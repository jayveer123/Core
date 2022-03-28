<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Admin extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

	public function gridAction()
	{
		$this->setTitle('Admin');
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'grid');
		$this->randerLayout();
	}

	public function saveAction()
	{
		
		try{

			$adminModel = Ccc::getModel('Admin');

			$request = $this->getRequest();

			if(!$request->getPost('admin'))
			{
				throw new Exception("Invalid request", 3);
			}	

			$postData = $request->getPost('admin');

			if(!$postData)
			{
				throw new Exception("Invalid Request", 3);
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
					throw new Exception("Id Not Found", 3);
				}
				$admin->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$admin->updatedDate  = date('Y-m-d H:m:s');	
			}
			$admin->password = md5($postData["password"]);
			$result=$admin->save();
			
			if(!$result)
			{
				throw new Exception("Record Not Insert", 3);
			}
			$this->getMessage()->addMessage('Record Saved.',1);
			$this->redirect('grid','admin',[],true);
		}
		catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->redirect('grid','admin',[],true);
		}
		
	}
	public function addAction()
	{
		$this->setTitle('Admin Add');

		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;

		$content = $this->getLayout()->getContent();
		$adminAdd = Ccc::getBlock('Admin_Edit');
		Ccc::register('admin',$adminModel);
		$content->addChild($adminAdd,'add');
		$this->randerLayout();
	}

	public function editAction()
	{
		$this->setTitle('Admin Edit');

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
		$adminEdit = Ccc::getBlock('Admin_Edit');
		Ccc::register('admin',$adminData);
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
				throw new Exception("Invalid request", 3);
			}
			$adminId = $request->getRequest('id');

			if(!$adminId)
			{
				throw new Exception("Id Not Found", 3);
			}
			$admin = $adminModel;

			$result = $admin->load($adminId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Admin Data Delted Sucess',1);
		    $this->redirect('grid','admin',[],true);
		}
		catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->redirect('grid','admin',[],true);
		}
	}

	public function errorAction()
	{
		echo "error";
	}
	


}


?>