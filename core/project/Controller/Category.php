<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Category extends Controller_Core_Action{

	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'grid');
        $this->randerLayout();
	}


	public function saveAction()
	{
		error_reporting(0);

		try{

			$categoryModel = Ccc::getModel('Category');

            $request = $this->getRequest();
            $id = $request->getRequest('id');

            if($request->isPost()){
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);

                if(!empty($id)){
                    $categoryData->id = $id;
                    $categoryData->updatedDate = date('y-m-d h:m:s');
                    if(!$postData['parent_id']){
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result){
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) {
                            if($subPath == $id){
                                if(count($finalPath) != 1){
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path->parent_id){
                            $parentPath = $categoryModel->load($path->parent_id);
                            $path->path = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else{
                            $path->path = $path->id;
                        }
                        $result = $path->save();
                    }
                }
                else{
                    $categoryData->createdDate = date('y-m-d h:m:s');

                    if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);

                        $insertId = $categoryModel->save();

                        
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->resetData();
                        $categoryData->path = $insertId;
                        $categoryData->id = $insertId;
                        $result = $categoryModel->save(); 
                    }
                    else{
                        $insertId = $categoryModel->save();
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->id = $insertId;
                        $parentPath = $categoryModel->load($categoryData->parent_id);
                        $categoryData->path = $parentPath->path."/". $insertId;
                        $result = $categoryData->save();
                    }
                    if(!$result){
                        throw new Exception("Sysetm is unable to save your data", 1);   
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
		$categoryModel = Ccc::getModel('Category');
        $request = $this->getRequest();
        $id = $request->getRequest('id');
        if(!$id){
            throw new Exception("Invalid request", 1);
        }
        if(!(int)$id){
            throw new Exception("Invalid request", 1);
        }
        $category = $categoryModel->load($id);
        if(!$category){
            throw new Exception("Invalid request", 1);
        }

        $content = $this->getLayout()->getContent();
        $categoryEdit = Ccc::getBlock('Category_Edit')->addData('category',$category);
        $content->addChild($categoryEdit,'edit');
        $this->randerLayout();
	}

	public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
        $category = $categoryModel;

        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('Category_Edit')->addData('category',$category);
        $content->addChild($categoryAdd,'add');
        $this->randerLayout();
	}

	public function deleteAction()
	{
		try{
			$categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            if(!$request->getRequest('id')){
                throw new Exception("Invalid Request", 1);
            }
            $id = $request->getRequest('id');

            $datas = $categoryModel->fetchAll("SELECT imageName FROM category_media WHERE  categoryId='$id'");
            foreach ($datas as $data) {
                unlink($this->getView()->getBaseUrl("Media/Category/"). $data->imageName);
            }

            $result = $categoryModel->load($id)->delete();
            if(!$result){
                throw new Exception("System is unable to delete data.", 1);
            }
            $this->redirect($this->getView()->getUrl('category','grid',[],true));
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
	}


}


?>