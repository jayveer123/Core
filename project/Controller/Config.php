<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Config extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    
	/*public function gridAction()
	{
		$this->setTitle('Config');
		$content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid,'grid');
        $this->randerLayout();
	}*/
	public function indexAction()
	{
		
		$this->setTitle('Config');
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Index');
		$content->addChild($configGrid);

		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
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
				unset($config->id);	
				date_default_timezone_set("Asia/Kolkata");
				$config->createdDate = date('Y-m-d H:m:s');
			}
			else{
				
				if(!(int)$postData['id'])
				{
					$this->getMessage()->addMessage('Invalid request',3);
				}
				$config->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$config->updatedDate  = date('Y-m-d H:m:s');
			}
			$result=$config->save();
			
			if(!$result)
			{
				$this->getMessage()->addMessage('Record Not Saved.',3);
			}
			$this->gridBlockAction();

		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
	}
	public function addBlockAction()
	{
		$this->setTitle('Config Add');
		$configModel = Ccc::getModel('Config');
		$config = $configModel;

		Ccc::register('config',$config);

		$configedit = Ccc::getBlock('Config_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configedit
				],
				[
					'element' => '#configMessage',
					'content' => $messageBlock
				]
			]
		];

		$this->randerJson($response);
	}
	public function editBlockAction()
	{
		try{
			$this->setTitle('Config Edit');
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
				$this->getMessage()->addMessage('Config Data Cant Find',3);
			}

			Ccc::register('config',$configData);


			$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configEdit
					],
					[
						'element' => '#configMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);

		}catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}
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

			$result = $config->load($configId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Dara delete Successfuly',1);
			$this->gridBlockAction();
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