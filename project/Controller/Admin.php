<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Admin extends Controller_Core_Action{
	
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
			

			if (empty($postData['id'])) {
				
				date_default_timezone_set("Asia/Kolkata");
				$admin->createdDate = date('Y-m-d H:m:s');
				
				unset($admin->id);	
				$insert = $admin->save();
				
				if(!$insert)
				{
					$this->getMessage()->addMessage('Admin Data Not Inserted',3);
				}
				$this->getMessage()->addMessage('Admin Data save succesfully',1);
			}
			else{
				
				if(!(int)$postData['id'])
				{
					$this->getMessage()->addMessage('Id Not Found',3);
				}
				$admin->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$admin->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $admin->save();

				if(!$update)
				{
					throw new Exception("Admin Data Not Updated", 3);
				}
				$this->getMessage()->addMessage('Admin Data updated succesfully',1);
			}
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}


		$this->redirect($this->getView()->getUrl('admin','grid',[],true));
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
		$this->redirect($this->getView()->getUrl('admin','grid',[],true));
		
	}

	public function errorAction()
	{
		echo "error";
	}
	


}


?>