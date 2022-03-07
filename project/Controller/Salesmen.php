<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Salesmen extends Controller_Core_Action{
	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $salesmenGrid = Ccc::getBlock('Salesmen_Grid');
        $content->addChild($salesmenGrid,'grid');
        $this->randerLayout();
	}
	public function addAction()
	{
		$salesmenModel = Ccc::getModel('Salesmen');
		$salesmen = $salesmenModel;

		$content = $this->getLayout()->getContent();
        $salesmenAdd = Ccc::getBlock('Salesmen_Edit')->setData(['salesmen'=>$salesmen]);
        $content->addChild($salesmenAdd,'add');
        $this->randerLayout();
	}

	public function editAction()
	{
			$salesmenModel = Ccc::getModel('Salesmen');
			$salesmen = $salesmenModel;

			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$salesmenData = $salesmen->load($id);
			if(!$salesmenData)
			{
				$this->getMessage()->addMessage('Unable To Find Data',3);
			}

			$content = $this->getLayout()->getContent();
	        $salesmenEdit = Ccc::getBlock('Salesmen_Edit')->addData('salesmen',$salesmenData);
	        $content->addChild($salesmenEdit,'add');
	        $this->randerLayout();
	}
	public function deleteAction()
	{
		try {
			$salesmenModel = Ccc::getModel('Salesmen');
			$request = $this->getRequest();

			if (!$request->getRequest('id')) {
				throw new Exception("Id not Found", 1);
			}

			$id = $request->getRequest('id');

			$salesmen = $salesmenModel;
			$result = $salesmen->load($id)->delete();

			if (!$result) {
				$this->getMessage()->addMessage('Data Not Delted',3);
			}

			$this->getMessage()->addMessage('Data Deleted Successfully',1);
			$this->redirect($this->getView()->getUrl('salesmen','grid',[],true));
			
		} catch (Exception $e) {
			echo "<pre>";
			print_r($e);
		}
	}
	public function saveAction()
	{
		try {
			date_default_timezone_set("Asia/Kolkata");

			$salesmenModel = Ccc::getModel('Salesmen');
			$request = $this->getRequest();

			if (!$request->getPost('salesmen')) {
				$this->getMessage()->addMessage('Invalid Request',3);
			}

			$postData = $request->getPost('salesmen');

			if(!$postData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}

			$id = $request->getRequest('id');

			$salesmen = $salesmenModel;
			$salesmen->setdata($postData);

			if(empty($id)){
				
				$salesmen->createdDate = date('Y-m-d H:m:s');
				
				unset($salesmen->id);	
				$insert = $salesmen->save();
				
				if(!$insert)
				{
					$this->getMessage()->addMessage('Data Not Inserted',3);
				}
				$this->getMessage()->addMessage('Data Inserted Successfully',1);
			}
			else
			{
				if(!(int)$id)
				{
					throw new Exception("Invalid Request.", 1);
				}

				$salesmen->id = $id;
				$salesmen->updatedDate  = date('Y-m-d H:m:s');

				$update = $salesmen->save();

				if (!$update) {
					$this->getMessage()->addMessage('Data Not Updated',3);
				}
				$this->getMessage()->addMessage('Data Updated Successfully',1);

			}
			$this->redirect($this->getView()->getUrl('salesmen','grid',[],true));

		} catch (Exception $e) {
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