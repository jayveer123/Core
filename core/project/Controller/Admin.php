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
				throw new Exception("Invalid Request", 1);
			}	

			$postData = $request->getPost('admin');

			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
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
					throw new Exception("System is unable to Insert.", 1);
				}

			}
			else{
				
				if(!(int)$postData['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$admin->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$admin->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $admin->save();

				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}	
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
				throw new Exception("Id Not Found", 1);
				
			}
			$adminData = $admin->load($id);
			if(!$adminData)
			{
				throw new Exception("System is unable to find record.", 1);
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
				throw new Exception("Invalid Request.", 1);
			}

			$adminId = $request->getRequest('id');

			if(!$adminId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$admin = $adminModel;

			$result = $admin->load($adminId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
		    
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