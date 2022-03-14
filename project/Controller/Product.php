<?php Ccc::loadClass('Controller_Admin_Action'); ?>

	
<?php
class Controller_Product extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
        }
    }
    
	public function gridAction()
	{
		$this->setTitle('Product');
		$content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('Product_Grid');
        $content->addChild($productGrid,'grid');
        $this->randerLayout();
	}

	public function saveAction()
	{

		error_reporting(0);

		try{

			$productModel = Ccc::getModel('Product');

			$request = $this->getRequest();

			if(!$request->getPost('product'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);
			}	

			$postData = $request->getPost('product');
			$categoryIds = $request->getPost('category');
			if(!$postData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}
			$product = $productModel;
			$product->setdata($postData);
			$productId = $product->id;	

			if (!($productId)) {
				unset($product->id);	
				date_default_timezone_set("Asia/Kolkata");
				$product->createdDate = date('Y-m-d H:m:s');
			}
			else{
				
				if(!(int)$productId)
				{
					$this->getMessage()->addMessage('Id Not Found',3);
				}
				$product->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$product->updatedDate  = date('Y-m-d H:m:s');
			
			}
			$result=$product->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('Record Not Inserted.',3);
			}

			if(!$categoryIds)
			{
				$categoryIds['exists'] = []; 
			}
			$product->saveCategories($categoryIds);
			$this->redirect('product','grid',[],true);
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
	}

	public function editAction()
	{
			$this->setTitle('Product Edit');
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				$this->getMessage()->addMessage('Id Not Found',3);
			}
			$product = $productModel->fetchRow("SELECT * FROM product WHERE id = {$id}");
			if(!$product)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}

			$content = $this->getLayout()->getContent();
	        $productEdit = Ccc::getBlock('Product_Edit')->addData('product',$product);
	        $content->addChild($productEdit,'edit');
	        $this->randerLayout();
	}

	public function addAction()
	{	
		$this->setTitle('Product Add');
		$productModel = Ccc::getModel('Product');

		$content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
        $content->addChild($productAdd,'add');
        $this->randerLayout();
	}

	public function deleteAction()
	{
		try{

			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				$this->getMessage()->addMessage('Invalid Request',3);	
			}

			$productId = $request->getRequest('id');

			if(!$productId)
			{
				$this->getMessage()->addMessage('Id Not Found',3);				
			}
			
			$datas = $productModel->fetchAll("SELECT imageName FROM product_media WHERE  productId='$productId'");
			foreach ($datas as $data) {
				unlink($this->getView()->getBaseUrl("Media/Product/"). $data->imageName);
			}

			$result = $productModel->load($productId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);	
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Delted Sucess',1);	
		    $this->redirect('product','grid',[],true);
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