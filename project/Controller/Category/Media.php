<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Category_Media extends Controller_Core_Action{

	public function gridAction()
	{
		$this->setTitle('Category Media');
		$content = $this->getLayout()->getContent();
        $categoryMediaGrid = Ccc::getBlock('Category_Media_Grid');
        $content->addChild($categoryMediaGrid,'grid');
        $this->randerLayout();
	}
	public function saveAction()
	{
		try{
			$mediaModel = Ccc::getModel('Category_Media');
			$request = $this->getRequest();
			$category_id = $request->getRequest('id');

			if($request->isPost()){
				if(!$request->getPost()){

					$media = $mediaModel;
					$media->categoryId = $category_id;

					$file = $request->getFile();
					$ext = explode('.',$file['imageName']['name']);
					$fileExt = end($ext);

					$media->imageName = prev($ext)."".date('Ymdhis').".".$fileExt;
					$media->imageName = str_replace(" ","_",$media->imageName);
					$extension = array('jpg','jpeg','png');

					if(in_array($fileExt, $extension)){
						$result = $media->save();
						if(!$result){
							$this->getMessage()->addMessage('Unable To Save Category Media',3);
						}	
						move_uploaded_file($file['imageName']['tmp_name'],Ccc::getBlock('Category_Media_Grid')->getBaseUrl("Media/Category/").$media->imageName);
					}
					$this->getMessage()->addMessage('Category Media Saved Succesfully',1);
				}else{

					$media = $mediaModel;

					$categoryModel = $mediaModel->getCategory();
					$categoryData = $categoryModel;

					$categoryData->id = $category_id;
					$media->categoryId = $category_id;

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
							unlink(Ccc::getBlock('Category_Media_Grid')->getBaseUrl("Media/Category/"). $media->imageName);

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
						$result = $mediaModel->save('categoryId');
						$media->gallery = 1;
						foreach ($postData['media']['gallery'] as $gallery) {
							$media->imageId = $gallery;
							$result = $mediaModel->save();

							if(!$result){
								$this->getMessage()->addMessage('Invalid request',3);
							}
						}
						$this->getMessage()->addMessage('Gallary Set Succesfully',1);
						unset($media->imageId);
					}
					else
					{
						$media->gallery = 0;
						$result = $mediaModel->save('categoryId');
						$this->getMessage()->addMessage('successfully updated.',1);
					}
					unset($media->gallery);

					if(array_key_exists('base',$postData['media']))
					{
						$categoryData->base = $postData['media']['base'];
						$result = $categoryModel->save();
						if(!$result)
						{
							throw new Exception("System is unabel to set base", 1);
						}
						unset($categoryData->base);
					}
					if(array_key_exists('thumb',$postData['media']))
					{
						$categoryData->thumb = $postData['media']['thumb'];
						$result = $categoryModel->save();
						if(!$result)
						{
							throw new Exception("System is unabel to set thumb", 1);
						}
						unset($categoryData->thumb);
					}
					if(array_key_exists('small',$postData['media']))
					{
						$categoryData->small = $postData['media']['small'];
						$result = $categoryModel->save();
						if(!$result)
						{

							throw new Exception("System is unabel to set small", 1);
						}
						unset($categoryData->small);
					}
				}
			}
			$this->redirect('grid','category_media',['id' => $category_id],true);
		}
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}


}

?>