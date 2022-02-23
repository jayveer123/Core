<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Admin'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>

<?php
class Controller_Admin extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
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


			if (!array_key_exists('id',$postData)) {

				date_default_timezone_set("Asia/Kolkata");
				$postData['createdDate'] = date('Y-m-d H:m:s');

				$insert = $adminModel->insert($postData);

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
				$id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$postData['updatedDate']  = date('Y-m-d H:m:s');
				
				$update = $adminModel->update($postData,$id);

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

	public function editAction()
	{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE id = {$id}");
			if(!$admin)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
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
			$result = $adminModel->delete($adminId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
		    $this->redirect($this->getView()->getUrl('admin','grid',[],true));
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