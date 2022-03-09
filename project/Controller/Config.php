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
				$this->getMessage()->addMessage('Invalid request',3);
			}	

			$postData = $request->getPost('config');

			if(!$postData)
			{
				$this->getMessage()->addMessage('Invalid request',3);	
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
					$this->getMessage()->addMessage('Config Data Not Inserted',3);
				}
				$this->getMessage()->addMessage('Config  Data Inserted',1);

			}
			else{
				
				if(!(int)$postData['id'])
				{
					$this->getMessage()->addMessage('Invalid request',3);
				}
				$config->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$config->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $config->save();

				if(!$update)
				{
					$this->getMessage()->addMessage('Config Data Not Updated',3);
				}
				$this->getMessage()->addMessage('Config Data Updated',1);
			}
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}

		$this->redirect('config','grid',[],true);
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
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$configData = $config->load($id);
			if(!$configData)
			{
				$this->getMessage()->addMessage('Unable To Find Data',3);
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
				$this->getMessage()->addMessage('Invalid request',3);
			}

			$configId = $request->getRequest('id');

			if(!$configId)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$config = $configModel;

			$result = $config->load($configId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$this->getMessage()->addMessage('Dara delete Successfuly',1);
		    $this->redirect('config','grid',[],true);
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