<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Config extends Controller_Core_Action{
	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid,'grid');
        $this->randerLayout();
	}

	public function saveAction()
	{
		error_reporting(0);

		try{

			$configModel = Ccc::getModel('config');

			$request = $this->getRequest();

			if(!$request->getPost('config'))
			{
				throw new Exception("Invalid Request", 1);
			}	

			$postData = $request->getPost('config');

			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
			}
			$config = $configModel;
			$config->setdata($postData);
			

			if (empty($postData['id'])) {
				
				date_default_timezone_set("Asia/Kolkata");
				$config->createdDate = date('Y-m-d H:m:s');
				
				unset($config->id);	
				$insert = $config->save();
				
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
				$config->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$config->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $config->save();

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

		$this->redirect($this->getView()->getUrl('config','grid',[],true));
	}
	public function addAction()
	{
		$configModel = Ccc::getModel('Config');
		$config = $configModel;

		$content = $this->getLayout()->getContent();
        $configadd = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
        $content->addChild($configadd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
			$configModel = Ccc::getModel('Config');
			$config = $configModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id Not Found", 1);
				
			}
			$configData = $config->load($id);
			if(!$configData)
			{
				throw new Exception("System is unable to find record.", 1);
			}

			$content = $this->getLayout()->getContent();
	        $configedit = Ccc::getBlock('Config_Edit')->addData('config',$configData);
	        $content->addChild($configedit,'edit');
	        $this->randerLayout();
	}
	public function deleteAction()
	{
		try{
			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$configId = $request->getRequest('id');

			if(!$configId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$config = $configModel;

			$result = $config->load($configId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
		    $this->redirect($this->getView()->getUrl('config','grid',[],true));
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