<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Page extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    public function indexAction()
	{
		$this->setTitle("Page");
		$content = $this->getLayout()->getContent();
		$pageIndex = Ccc::getBlock('Page_Index');
		$content->addChild($pageIndex);
		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageGrid
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

		try{

			$pageModel = Ccc::getModel('page');

			$request = $this->getRequest();

			if(!$request->getPost('page'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}	

			$postData = $request->getPost('page');

			if(!$postData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}
			$page = $pageModel;
			$page->setdata($postData);
			

			if (empty($postData['id'])) {
				
				date_default_timezone_set("Asia/Kolkata");
				$page->createdDate = date('Y-m-d H:m:s');
				
				unset($page->id);	
				$insert = $page->save();
				
				if(!$insert)
				{
					$this->getMessage()->addMessage('Data Not Inserted',3);
				}
				$this->getMessage()->addMessage('Data Inserted',1);

			}
			else{
				
				if(!(int)$postData['id'])
				{
					$this->getMessage()->addMessage('Id Not Found',3);
				}
				$page->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$page->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $page->save();

				if(!$update)
				{
					$this->getMessage()->addMessage('Unable To Update',3);
				}
				$this->getMessage()->addMessage('Data Updated',1);
			}
			$this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
	}
	public function deleteAction()
	{
		try{
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$pageId = $request->getRequest('id');

			if(!$pageId)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$page = $pageModel;

			$result = $page->load($pageId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Deleted Successfully',1);
		   	$this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
		
	}
	public function addBlockAction()
	{
		$pageModel = Ccc::getModel("Page");
		$page = $pageModel;
		$address = $pageModel;

		Ccc::register('page',$page);

		$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageEdit
				],
				[
					'element' => '#pageMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
		
	}
	public function editBlockAction()
	{
		try 
   		{
   			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$page = $pageModel->load($id);
			if(!$page)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$this->setTitle('Page Edit');
			Ccc::register('page',$page);

			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $pageEdit
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
   		}catch(Exception $e){

   		}
   	}

}

?>