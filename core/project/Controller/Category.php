<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Category extends Controller_Core_Action{

	
	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}


	public function saveAction()
	{
		error_reporting(0);

		try{

			$request = $this->getRequest();
            $postData = $request->getPost('category');
            if(!$postData)
            {
                throw new Exception("Request Invalid.",1);
            }
            
            $adapter = new Model_Core_Adapter();
            
            $categoryName = $postData['c_name'];
            $categoryParentID = $postData['parent_id'];
            $categoryStatus = $postData['c_stetus'];

            date_default_timezone_set("Asia/Kolkata");
            $date = date('y-m-d h:m:s');

            if(!array_key_exists('id', $postData))
            {
            	if(empty($categoryParentID))
                {
                    $result = $adapter->insert("INSERT INTO `category` (`c_name`,`c_stetus`,`created_date`) VALUE ('$categoryName','$categoryStatus','$date')");
                    if(!$result){
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->update("UPDATE `category` SET `path` = '$result' WHERE `id` = '$result' ");
                }
                else
                {
                    $result = $adapter->insert("INSERT INTO `category` (`parent_id`,`c_name`,`c_stetus`,`created_date`) VALUE ('$categoryParentID','$categoryName','$categoryStatus','$date')");
                    if(!$result)
                    {
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->fetchAssos("SELECT * FROM `category` WHERE `id` = '$categoryParentID' ");
                    
                    $path = $path['path']."/".$result;
                    $newPath = $adapter->update("UPDATE `category` SET `path` = '$path' WHERE `id` = '$result' ");
                }
            }
            else{
            	$categoryID = $_GET['id'];
            	if(!(int)$categoryID){
                    throw new Exception("Invalid Request.", 1);
                }
                $parent = $postData['root'];

                $data = $adapter->update("UPDATE category SET c_name ='$categoryName', c_stetus ='$categoryStatus', updatedDate ='$date' where id = '$categoryID'");

                if(empty($parent))
                {

                    $path = $adapter->update("UPDATE category SET parent_id = NULL,`path`='$categoryID' WHERE id = '$categoryID'");

                    $parentID = $postData['parent_id'];

                    $data = $adapter->fetchAll("SELECT * FROM category WHERE `path` LIKE '%$categoryID%'");

                    foreach($data as $allData)
                    {
                        $path = $allData['path'];
                        if($allData['id']!=$categoryID)
                        {
                            $currentID = $allData['id'];
                            $updatePath = ltrim($path , $parentID);
                            $finalPath = ltrim($updatePath , '/');
                            $parentID = $allData['parent_id'];
		                              
                            $path = $adapter->update("UPDATE category SET parent_id=$parentID,`path`='$finalPath' WHERE id='$currentID'");
                        }
                    }
                }
                else{
                	$parentID = $postData['parent_id'];

                    $row = $adapter->fetchAssos("SELECT * FROM category WHERE id='$parent'");
                    $parentPath = $row['path'];

                    $query = $adapter->fetchAssos("SELECT * FROM category where id='$categoryID'");
                    $currentpath = $query['path'];

                    $possiblePath = $adapter->fetchAll("SELECT * from category where `path` LIKE '$currentpath%'");

                    foreach($possiblePath as $allPath)
                    {
                        $currentID = $allData['id'];
                        $path = $allPath['path'];

                        $updatePath = ltrim($path , $parentID);
                        $updatePath = ltrim($updatePath , '/');

                        $updatePath = explode('/', $updatePath);

                                
                        foreach ($updatePath as $value) {
                            if($value==$categoryID){
                                break;
                            }
                            array_shift($updatePath);
                        }
                        
                        $path = implode('/', $updatePath);

                        if($allPath['id']!=$categoryID)
                        {
                            $parent = $allPath['parent_id']; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentID = $allPath['id']; 
                        }
                        else
                        {
                            $parent = $parentPath; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentID = $allPath['id']; 
                        }

                        $path = $adapter->update("UPDATE category SET parent_id='$parent',`path` = '$FinalUpdate' WHERE id = '$currentID'");
                    }
                    if(!$path)
                    {
                        
                        throw new Exception("Data Not Upadated", 1);
                    }
                }
            }

			$this->redirect($this->getView()->getUrl('category','grid'));
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
		
	}

	public function editAction()
	{
		$categoryID=(int)$this->getRequest()->getRequest('id');
            if(!isset($categoryID)){
                throw new Exception("Invalid Request.", 1);
            }
            $categoryModel = Ccc::getModel('Category');        
            $adapter = new Model_Core_Adapter();
            $category = $adapter->fetchAssos("SELECT * FROM `category` WHERE `id` = '$categoryID'");
            $categories = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` NOT LIKE '%$categoryID%' ORDER BY `path` ASC");
            Ccc::getBlock('Category_Edit')->addData('category',$category)->addData('categories',$categories)->toHtml();

	}

	public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
        $categories = $categoryModel->fetchAll("SELECT * FROM category ORDER BY `path` ASC");
        
        Ccc::getBlock('Category_Add')->addData('categories',$categories)->toHtml();
	}

	public function deleteAction()
	{
		try{
			 $categoryID=(int)$this->getRequest()->getRequest('id');
                if(!isset($categoryID))
                {
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryModel = Ccc::getModel('Category');

                $result = $categoryModel->delete($categoryID);
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect($this->getView()->getUrl('category','grid'));
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