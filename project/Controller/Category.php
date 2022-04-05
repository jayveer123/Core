<?php Ccc::loadClass('Controller_Admin_Action'); ?>

<?php
class Controller_Category extends Controller_Admin_Action{

	public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

	public function indexAction()
    {
        $this->setTitle('Category');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Index');
        $content->addChild($categoryGrid);

        $this->randerLayout();
    }
    public function gridBlockAction()
    {
        $categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $categoryGrid
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->randerJson($response);
    }
    public function addBlockAction()
    {

        $categoryModel = Ccc::getModel("Category");
        $media = $categoryModel->getMedia();

        Ccc::register('category',$categoryModel);
        Ccc::register('media',$media);

        $categoryEdit = $this->getLayout()->getBlock('Category_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $categoryEdit
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
            $this->setTitle('Edit Category');
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            $id = $request->getRequest('id');
            
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }

            if(!(int)$id)
            {
                throw new Exception("Request Invalid.");
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                throw new Exception("System is unable to find record.");
            }
            $media = $category->getMedia();

            Ccc::register('category',$category);
            Ccc::register('media',$media);

            $categoryEdit = $this->getLayout()->getBlock('Category_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $categoryEdit
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

	public function saveAction()
	{
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

                $categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
                $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
                $url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $categoryModel->categoryId,'tab'=>'media']);
                $response = [
                    'status' => 'success',
                    'elements' => [
                        [
                            'element' => '#adminMessage',
                            'content' => $messageBlock
                        ],
                        [
                            'element' => '#indexContent',
                            'content' => $categoryGrid,
                            'url' => $url
                        ]
                    ]
                ];
                $this->randerJson($response);
                
            }
		}
		catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
		}
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

            $result = $categoryModel->load($id);
            if(!$result){
                $this->getMessage()->addMessage('Category Data Not Deleted',3);
            }
            $result->delete();
            $this->getMessage()->addMessage('Category Data Deleted Successfully',1);
            $this->gridBlockAction();
		}
		catch(Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
		}
	}

    public function saveMediaAction()
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

                            if($mediaData){
                                unlink(Ccc::getBlock('Category_Media_Grid')->getBaseUrl("Media/Category/"). $mediaData->imageName);
                            }
                            $result = $mediaData->delete();
                            if(!$result)
                            {
                                $this->getMessage()->addMessage('unable to delete.',3);
                                throw new Exception("Invalid request", 1);
                            }
                            

                            if(array_key_exists('base',$postData['media'])){
                                if($postData['media']['base'] == $remove){
                                    unset($postData['media']['base']);
                                }   
                            }

                            if(array_key_exists('thumb',$postData['media'])){
                                if($postData['media']['thumb'] == $remove){
                                    unset($postData['media']['thumb']);
                                }
                            }

                            if(array_key_exists('small',$postData['media'])){
                                if($postData['media']['small'] == $remove){
                                    unset($postData['media']['small']);
                                }
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
            $this->editBlockAction();
        }
        catch (Exception $e) 
        {
            $this->editBlockAction();
        }
    }


}


?>