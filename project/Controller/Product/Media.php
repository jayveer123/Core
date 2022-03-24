<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		$this->setTitle('Product Media');
		$content = $this->getLayout()->getContent();
        $productMediaGrid = Ccc::getBlock('Product_Media_Grid');
        $content->addChild($productMediaGrid,'grid');
        $this->randerLayout();
	}
	public function saveAction()
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
					$this->redirect('product_media','grid',[],true);
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
							$result = $mediaData->delete();
							if(!$result)
							{
								$this->getMessage()->addMessage('unable to delete.',3);
								throw new Exception("Invalid request", 1);
							}
							unlink(Ccc::getBlock('Product_Media_Grid')->getBaseUrl("Media/Product/"). $media->imageName);
							
							if($postData['media']['base'] == $remove)
							{
								unset($postData['media']['base']);
							}
							if($postData['media']['thumb'] == $remove)
							{
								unset($postData['media']['thumb']);
							}
							if($postData['media']['small'] == $remove)
							{
								unset($postData['media']['small']);
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
			$this->redirect('product_media','grid',['id' => $product_id],true);
		}catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

}

?>