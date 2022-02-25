<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Product_Media_Grid')->toHtml();
	}
	public function saveAction()
	{
		$request = $this->getRequest();
		$product_id = $request->getRequest('id');

		if($request->isPost()){
			$row = $request->getPost();

			try {
				$row['productId'] = $product_id;

				$file = $request->getFile();


				$ext = explode('.',$file['imageName']['name']);
				$fileExt = end($ext);

				$row['imageName'] = prev($ext)."".date('Ymdhis').".".$fileExt;
				$row['imageName'] = str_replace(" ","_",$row['imageName']);

				
				$extension = array('jpg','jpeg','png');
				if(in_array($fileExt, $extension)){
					$add = Ccc::getModel('Product_Media');
					
					$result = $add->insert($row);

					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}	
					move_uploaded_file($file['imageName']['tmp_name'],$this->getView()->getBaseUrl("Media/Product/").$row['imageName']);
				}

				$this->redirect($this->getView()->getUrl('product_media','grid'));	
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

			$edit = Ccc::getModel('Product_Media');
			if(!$request->isPost()){
				throw new Exception("Invalid request.", 1);
			}
			$rows = $request->getPost();
			echo "<pre>";
			if(array_key_exists('media',$rows) && array_key_exists('base',$rows['media'])){
				$result = $edit->update(['base' => 0],$productId,'productId');
				if($result){
					$base = $edit->update(['base' => 1],$rows['media']['base']);
				}
			}
			if(array_key_exists('media',$rows) && array_key_exists('thumb',$rows['media'])){
				$result = $edit->update(['thumb' => 0],$productId,'productId');
				if($result){
					$thumb = $edit->update(['thumb' => 1],$rows['media']['thumb']);
					print_r($thumb);
				}
			}
			if(array_key_exists('media',$rows) && array_key_exists('small',$rows['media'])){
				$result = $edit->update(['small' => 0],$productId,'productId');
				if($result){
					$small = $edit->update(['small' => 1],$rows['media']['small']);
					print_r($small);
				}
			}
			unset($rows['media']);
			foreach($rows as $row){
				if(array_key_exists('remove',$row)){
					$result = $edit->delete($row['imageId']);
					if(!$result){
						throw new Exception("Invalid request", 1);
					}
					unlink($this->getView()->getBaseUrl("Media/Product/"). $row['imageName']);
				}

				if(array_key_exists('gallary',$row)){
					$result = $edit->update(['gallary' => 1],$row['imageId']);
				}
				else{
					$result = $edit->update(['gallary' => 0],$row['imageId']);
				}
			}
			$this->redirect($this->getView()->getUrl('product_media','grid',['id' => $productId],true));	
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

}

?>