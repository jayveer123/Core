<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Admin extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

	/*public function gridAction()
	{
		$this->setTitle('Admin');
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'grid');
		$this->randerLayout();
	}*/
	public function indexAction()
	{
		$this->setTitle('Admin');
		$content = $this->getLayout()->getContent();
		$admingrid = Ccc::getBlock('Admin_Index');
		$content->addChild($admingrid);

		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		$admingrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $admingrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}
	public function addBlockAction()
	{
		$this->setTitle('Admin Add');
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;

		Ccc::register('admin',$admin);

		$adminedit = $this->getLayout()->getBlock('Admin_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminedit
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];

		$this->randerJson($response);
	}
	public function editBlockAction()
	{
		try{
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

			Ccc::register('admin',$adminData);


			$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminEdit
					],
					[
						'element' => '#adminMessage',
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
	/*public function gridContentAction()
	{
		$this->setTitle('Admin Grid');
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'grid');	
		$this->randerContent();
	}*/
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

			$this->getMessage()->addMessage("Data Inserted",1);
			$this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
			//$this->redirect('grid','admin',[],true);
		}
		
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

			$this->getMessage()->addMessage("Data Deleted",1);
			$this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
	}

	public function errorAction()
	{
		echo "error";
	}
	


}


?>