<?php Ccc::loadClass('Controller_Core_Action'); ?>

	
<?php
class Controller_Product extends Controller_Core_Action{
	
	public function gridAction()
	{
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
			$categoryData = $request->getPost('category');
			if(!$postData)
			{
				$this->getMessage()->addMessage('Data Not Found',3);
			}
			$product = $productModel;
			$product->setdata($postData);
			$productId = $postData['id'];	

			if (empty($productId)) {
				
				date_default_timezone_set("Asia/Kolkata");
				$product->createdDate = date('Y-m-d H:m:s');
				
				unset($product->id);	
				$insert = $product->save();
				
				if(!$insert)
				{
					$this->getMessage()->addMessage('Data Not Inserted',3);
				}

				foreach($categoryData as $category){
					$categoryProductModel = Ccc::getModel('Product_categoryProduct');
					$categoryProductModel->product_id = $insert;
					$categoryProductModel->category_id = $category;
					$categoryProductModel->save();
				}

				$this->getMessage()->addMessage('Data Inserted Successfully',1);
			}
			else{
				
				if(!(int)$productId)
				{
					$this->getMessage()->addMessage('Id Not Found',3);
				}
				$product->id = $postData["id"];

				date_default_timezone_set("Asia/Kolkata");
				$product->updatedDate  = date('Y-m-d H:m:s');
			
				$update = $product->save();

				if(!$update)
				{
					$this->getMessage()->addMessage('Data Not Updated',3);
				}

				$categoryProductModel = Ccc::getModel('Product_categoryProduct');
				$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$productId' ");
				foreach($categoryProduct as $category){
					$categoryProductModel->load($category->entity_id)->delete();
				}
				foreach($categoryData as $category){
					$categoryProductModel = Ccc::getModel('Product_categoryProduct');
					$categoryProductModel->product_id = $productId;
					$categoryProductModel->category_id = $category;
					$categoryProductModel->save();
				}

				$this->getMessage()->addMessage('Data Updated Successfully',1);
			}
			
			
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
	}

	public function editAction()
	{
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

			$result = $productModel->load($productId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);	
			}

			$this->getMessage()->addMessage('Data Delted Sucess',1);	
		    $this->redirect($this->getView()->getUrl('product','grid',[],true));
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