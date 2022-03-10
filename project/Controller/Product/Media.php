<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $productMediaGrid = Ccc::getBlock('Product_Media_Grid');
        $content->addChild($productMediaGrid,'grid');
        $this->randerLayout();
	}
	public function saveAction()
	{
		$request = $this->getRequest();
		$product_id = $request->getRequest('id');

		if($request->isPost()){
			try {
				$mediaModel = Ccc::getModel('Product_Media');

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
					move_uploaded_file($file['imageName']['tmp_name'],$this->getView()->getBaseUrl("Media/Product/").$media->imageName);
				}

				$this->getMessage()->addMessage('Data Save Succesfully',1);	
				$this->redirect('product_media','grid',[],true);

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
		
	}

	public function editAction()
	{
		try{
			$request = $this->getRequest();
			$productId = $request->getRequest('id');

			$mediaModel = Ccc::getModel('Product_Media');

			if(!$request->isPost()){
				$this->getMessage()->addMessage('Invalid Request',3);	
			}

			$rows = $request->getPost();
			$media = $mediaModel;

			if(array_key_exists('media',$rows) && array_key_exists('base',$rows['media']))
			{
				$media->base = $rows['media']['base'];
				$media->id = $productId;
				
				$result = $mediaModel->save('id','product');
				if(!$result){
					$this->getMessage()->addMessage('Unable To Set Base',3);
				}
				unset($media->base);
			}
			if(array_key_exists('media',$rows) && array_key_exists('thumb',$rows['media']))
			{
				$media->thumb = $rows['media']['thumb'];
				$media->id = $productId;
				
				$result = $mediaModel->save('id','product');
				if(!$result){
					$this->getMessage()->addMessage('Unable To Set thumb',3);
				}
				unset($media->thumb);
			}
			if(array_key_exists('media',$rows) && array_key_exists('small',$rows['media']))
			{
				
				$media->small = $rows['media']['small'];
				$media->id = $productId;
				
				$result = $mediaModel->save('id','product');
				if(!$result){
					$this->getMessage()->addMessage('Unable To Set Small',3);
				}
				unset($media->small);
			}


			
				
				unset($media->id);
				$media->productId = $productId;

				if(array_key_exists('gallery',$rows['media'])){
					$media->gallery = 0;
					$result = $mediaModel->save('productId');
					$media->gallery = 1;
					foreach ($rows['media']['gallery'] as $gallery) {
						$media->imageId = $gallery;
						$result = $mediaModel->save();
						
						if(!$result){
							$this->getMessage()->addMessage('Invalid request',3);
						}
					}
					$this->getMessage()->addMessage('Gallary Set Succesfully',1);	
					unset($media->imageId);
				}
				else{
					$media->gallery = 0;
					$result = $mediaModel->save('productId');
				}
				unset($media->gallery);


				if(array_key_exists('remove',$rows['media'])){
					foreach($rows['media']['remove'] as $remove){
						$media = $mediaModel->load($remove);
						$result = $media->delete();
						if(!$result){
							$this->getMessage()->addMessage('Invalid Request',3);
						}
						unlink($this->getView()->getBaseUrl("Media/Product/"). $media->imageName);
							
						if($rows['media']['base'] == $remove){
							unset($rows['media']['base']);
						}
						if($rows['media']['thumb'] == $remove){
							unset($rows['media']['thumb']);
						}
						if($rows['media']['small'] == $remove){
							unset($rows['media']['small']);
						}

					}
					$this->getMessage()->addMessage('Product Media Remove Succesfully',1);
				}

				$this->redirect('product_media','grid',['id' => $productId],true);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

}

?>