<?php Ccc::loadClass('Controller_Admin_Action'); ?>

	
<?php
class Controller_Product extends Controller_Admin_Action{
	
	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }
    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Index');
		$content->addChild($productGrid);

		$this->randerLayout();
	}
	public function gridBlockAction()
	{
		$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productGrid,
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

			$product = null;
			$category = null;

			$request=$this->getRequest();
			$productModel= Ccc::getModel('Product');
			$categoryIds = $request->getPost('category');
			$productId = $request->getRequest('id');
			$type = $request->getPost('discountMethod');
			if($request->isPost())
			{
				$postData = $request->getPost('product');
				if($postData)
				{
					if(!$postData)
					{
						throw new Exception('Your data con not be updated', 1);			
					}
					$productData = $productModel->setData($postData);
					if($type == 1)
					{
						$productData->discount = $productData->p_price * $productData->discount / 100;
					}
					if(!($productData->cost_price <= ($productData->p_price - $productData->discount) && $productData->p_price - $productData->discount <= $productData->p_price) || $productData->discount<0)
					{
						throw new Exception("Invalid discount", 1);
					}
					if($productData->id)
					{
						$productData->updatedDate = date('Y-m-d h:i:s');
					}
					else
					{
						unset($productData->id);
						$productData->createdDate = date('Y-m-d h:i:s');
					}
					$product = $productData->save();	
					if(!$product)
					{
						throw new Exception('product con not be saved', 1);			
					}
				}
				if(array_key_exists('category',$request->getPost()))
				{
					$categoryIds = $request->getPost('category');
					$product = $productModel;
					$product->id = $productId;
					$category = $product->saveCategories($categoryIds);
				}
				elseif(!array_key_exists('product',$request->getPost()))
				{
					$categoryIds = $request->getPost('category');
					$product = $productModel;
					$product->id = $productId;
					$category = $product->saveCategories($categoryIds);
				}
				$this->getMessage()->addMessage('product Save Successfully');
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
			
			$datas = $productModel->fetchAll("SELECT imageName FROM product_media WHERE  id='$productId'");
			foreach ($datas as $data) {
				unlink(Ccc::getBlock('Product_Media_Grid')->getBaseUrl("Media/Product/"). $data->imageName);
			}

			$result = $productModel->load($productId);
			if(!$result)
			{
				$this->getMessage()->addMessage('Data Not Delted',3);	
			}
			$result->delete();
			$this->getMessage()->addMessage('Data Delted Sucess',1);	
		    $this->gridBlockAction();
		}
		catch(Exception $e){
			$this->gridBlockAction();
		}
		
	}
	public function addBlockAction()
	{
		$productModel = Ccc::getModel('Product');
		$product = $productModel;
		$media = Ccc::getModel('Product_Media');

		Ccc::register('product',$product);
		Ccc::register('media',$media);
		$productEdit = Ccc::getBlock('Product_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productEdit,
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
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if(!$productId)
			{	
				$this->getMessage()->addMessage('Your data con not be fetch', 3);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$productId)
			{	
				$this->getMessage()->addMessage('Your data con not be fetch', 3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$product = $productModel->load($productId);
			if(!$product){	
				$this->getMessage()->addMessage('Your data con not be fetch', 3);
				throw new Exception("Error Processing Request", 1);			
			}
			$media = $product->getMedia();	
			Ccc::register('product',$product);
			Ccc::register('media',$media);
			$productEdit = Ccc::getBlock('Product_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productEdit,
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->gridBlockAction();
		}	
	}
	
	public function saveMediaAction()
	{
		try{
			$mediaModel = Ccc::getModel('Product_Media');
			$productModel = $mediaModel->getProduct();

			$request = $this->getRequest();
			$product_id = $request->getRequest('id');

			if($request->isPost()){
				if(!$request->getPost())
				{
					$media = $mediaModel;
					$media->productId = $product_id;

					$file = $request->getFile();
					$ext = explode('.',$file['imageName']['name']);
					$fileExt = end($ext);

					$media->imageName = prev($ext)."".date('Ymdhis').".".$fileExt;
					$media->imageName = str_replace(" ","_",$media->imageName);
					$extension = array('jpg','jpeg','png');

					if(in_array($fileExt, $extension)){
						$result = $media->save();
						if(!$result){
							$this->getMessage()->addMessage('Unable To Save Product Media',3);	
						}	
						move_uploaded_file($file['imageName']['tmp_name'],Ccc::getBlock('Product_Media_Grid')->getBaseUrl("Media/Product/").$media->imageName);
					}

					$this->getMessage()->addMessage('Data Save Succesfully',1);	
					
				}
				else
				{
					$media = $mediaModel;
					$productData = $productModel;

					$productData->id = $product_id;
					$media->productId = $product_id;

					$postData = $request->getPost();

					if(array_key_exists('remove',$postData['media']))
					{
						foreach($postData['media']['remove'] as $remove)
						{

							$mediaData = $mediaModel->load($remove);

							if($mediaData){
								unlink(Ccc::getBlock('Product_Media_Grid')->getBaseUrl("Media/Product/").$mediaData->imageName);
							}
						
							$result = $mediaData->delete();
							if(!$result)
							{
								$this->getMessage()->addMessage('unable to delete.',3);
								throw new Exception("Invalid request", 1);
							}
							
							if(array_key_exists('base',$postData['media']))
                            {
                                if($postData['media']['base'] == $remove)
                                {
                                    unset($postData['media']['base']);
                                }   
                            }
                            if(array_key_exists('thumb',$postData['media']))
                            {
                                if($postData['media']['thumb'] == $remove)
                                {
                                    unset($postData['media']['thumb']);
                                }
                            }
                            if(array_key_exists('small',$postData['media']))
                            {
                                if($postData['media']['small'] == $remove)
                                {
                                    unset($postData['media']['small']);
                                }
                            }
							$this->getMessage()->addMessage('Media Deleted Succesfully.',3);

						}
					}

					if(array_key_exists('gallery',$postData['media']))
					{
						$media->gallery = 0;
						$result = $mediaModel->save('productId');
						$media->gallery = 1;
						foreach ($postData['media']['gallery'] as $gallery) 
						{
							$media->imageId = $gallery;
							$result = $mediaModel->save();
							if(!$result)
							{
								$this->getMessage()->addMessage('unable to selected.',3);
								throw new Exception("Invalid request", 1);
							}
						}
						unset($media->imageId);
					}
					else
					{
						$media->gallery = 0;
						$result = $mediaModel->save('productId');
						$this->getMessage()->addMessage('successfully updated.',1);
					}
					unset($media->gallery);

					if(array_key_exists('base',$postData['media']))
					{
						$productData->base = $postData['media']['base'];
						$result = $productModel->save();
						if(!$result)
						{
							throw new Exception("System is unabel to set base", 1);
						}
						unset($productData->base);
					}
					if(array_key_exists('thumb',$postData['media']))
					{
						$productData->thumb = $postData['media']['thumb'];
						$result = $productModel->save();
						if(!$result)
						{
							throw new Exception("System is unabel to set thumb", 1);
						}
						unset($productData->thumb);
					}
					if(array_key_exists('small',$postData['media']))
					{
						$productData->small = $postData['media']['small'];
						$result = $productModel->save();
						if(!$result)
						{
							throw new Exception("System is unabel to set small", 1);
						}
						unset($productData->small);
					}
				}
			}
			$this->editBlockAction();
		}catch (Exception $e) {
			$this->editBlockAction();
		}
		
	}
	


}


?>