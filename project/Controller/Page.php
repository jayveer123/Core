<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Page extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    
	public function gridAction()
	{
		$this->setTitle('Page');
		$content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Grid');
        $content->addChild($pageGrid,'grid');
        $this->randerLayout();
	}

	public function saveAction()
	{
		error_reporting(0);

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
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}

		$this->redirect('grid','page',[],true);
	}
	public function addAction()
	{
		$this->setTitle('Page Add');
		$pageModel = Ccc::getModel('Page');
		$page = $pageModel;

		$content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
        $content->addChild($pageAdd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
			$this->setTitle('Page Edit');
			$pageModel = Ccc::getModel('Page');
			$page = $pageModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$pageData = $page->load($id);
			if(!$pageData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}

			$content = $this->getLayout()->getContent();
	        $pageEdit = Ccc::getBlock('Page_Edit')->addData('page',$pageData);
	        $content->addChild($pageEdit,'edit');
	        $this->randerLayout();
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
		    $this->redirect('grid','page',[],true);
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