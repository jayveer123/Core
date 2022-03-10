<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Category extends Controller_Admin_Action{

	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('admin_login','login');
        }
    }

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
            $categoryId = $request->getRequest('id');
            if($request->isPost()){
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);
                if(!empty($categoryId)){
                    $categoryData->id = $categoryId;
                    $categoryData->updatedDate = date('y-m-d h:m:s');
                }
                else{
                    $categoryData->createdDate = date('y-m-d h:m:s');
                    if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);
                    }
                }
                $category = $categoryModel->save();
                if(!$category){
                    $this->getMessage()->addMessage('Data Not Updated',3);
                }
                $category->savePath($categoryData);
                $this->getMessage()->addMessage('Your Data Saved Successfully');
                $this->redirect('category','grid',[],true);
            }
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
        $this->redirect('category','grid',[],true);
		
	}

	public function editAction()
	{
		$categoryModel = Ccc::getModel('Category');
        $request = $this->getRequest();
        $id = $request->getRequest('id');
        if(!$id){
            $this->getMessage()->addMessage('Category Id Not Found',3);
        }
        if(!(int)$id){
            $this->getMessage()->addMessage('Category Id Is Not Integer',3);
        }
        $category = $categoryModel->load($id);
        if(!$category){
            $this->getMessage()->addMessage('Category Data Cant load',3);
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
                $this->getMessage()->addMessage('Invalid request',3);
            }
            $id = $request->getRequest('id');

            $datas = $categoryModel->fetchAll("SELECT imageName FROM category_media WHERE  categoryId='$id'");
            foreach ($datas as $data) {
                unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $data->imageName);
            }

            $result = $categoryModel->load($id)->delete();
            if(!$result){
                $this->getMessage()->addMessage('Category Data Not Deleted',3);
            }
            $this->getMessage()->addMessage('Category Data Deleted Successfully',1);

            $this->redirect('category','grid',[],true);
		}
		catch(Exception $e){
			echo "<pre>";
			print_r($e);
		}
	}


}


?>