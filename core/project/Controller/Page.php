<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Page extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Page_Grid')->toHtml();
	}

	public function saveAction()
	{
		error_reporting(0);

		try{

			$pageModel = Ccc::getModel('page');

			$request = $this->getRequest();

			if(!$request->getPost('page'))
			{
				throw new Exception("Invalid Request", 1);
			}	

			$postData = $request->getPost('page');

			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
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
					throw new Exception("System is unable to Insert.", 1);
				}

			}
			else{
				
				if(!(int)$postData['id'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$page->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$page->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $page->save();

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

		$this->redirect($this->getView()->getUrl('page','grid',[],true));
	}
	public function addAction()
	{
		$pageModel = Ccc::getModel('Page');
		$page = $pageModel;
		Ccc::getBlock('Page_Edit')->setData(['page'=>$page])->toHtml();
	}

	public function editAction()
	{
			$pageModel = Ccc::getModel('Page');
			$page = $pageModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Id Not Found", 1);
				
			}
			$pageData = $page->load($id);
			if(!$pageData)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			Ccc::getBlock('Page_Edit')->addData('page',$pageData)->toHtml();
	}
	public function deleteAction()
	{
		try{
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$pageId = $request->getRequest('id');

			if(!$pageId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$page = $pageModel;

			$result = $page->load($pageId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
		    $this->redirect($this->getView()->getUrl('page','grid',[],true));
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