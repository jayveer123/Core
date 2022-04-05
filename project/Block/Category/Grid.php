<?php 

Ccc::loadClass('Block_Core_Grid');  

class Block_Category_Grid extends Block_Core_Grid {

	public function __construct()
	{
		parent::__construct();
        $this->prepareCollections();
	}
    public function prepareCollections()
    {

        $this->addColumn([
        'title' => 'Category Id',
        'type' => 'int',
        'key' =>'id'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'c_name'
        ],'Name');
        $this->addColumn([
        'title' => 'Base Image',
        'type' => 'varchar',
        'key' =>'base'
        ],'Base Image');
        $this->addColumn([
        'title' => 'Thumb Image',
        'type' => 'varchar',
        'key' =>'thumb'
        ],'Thumb Image');
        $this->addColumn([
        'title' => 'Small Image',
        'type' => 'varchar',
        'key' =>'small'
        ],'Small Image');
        $this->addColumn([
        'title' => 'Status',
        'type' => 'int',
        'key' =>'status'
        ],'Status');
        $this->addColumn([
        'title' => 'Created Date',
        'type' => 'datetime',
        'key' =>'createdDate'
        ],'Created Date');
        $this->addColumn([
        'title' => 'Updated Date',
        'type' => 'datetime',
        'key' =>'updatedDate'
        ],'Updated Date');
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'category' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'category' ],'Delete');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $categorys = $this->getCategorys();
        $this->setCollection($categorys);
        return $this;
    }
    public function getCategorys()
    {   
        $categoryModel = Ccc::getModel('Category');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));

        $page = $request->getRequest('p',1);
        $ppr = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('id') FROM `category`");

        $this->getPager()->execute($totalCount,$page,$ppr);

        $categorys = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`  LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $categoryColumn = [];
        if(!$categorys){
            return null;
        }
        foreach ($categorys as $category) 
        {
            $category->finalPath = $this->getPath($category->id,$category->path);
            array_push($categoryColumn,$category);
        }        
        return $categoryColumn;
    }
	public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $paths = explode("/",$path);
        foreach ($paths as $path)
         {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `id` = '$path' ");
            if($path != $categoryId)
            {
                $finalPath .= $category->c_name ." / ";
            }
            else
            {
                $finalPath .= $category->c_name;
            }
        }
        return $finalPath;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
    /*public function getMedia($imageId)
    {
        $mediaModel=Ccc::getModel('Category_Media');
        $query="SELECT * FROM `category_media` WHERE `imageId` = {$imageId}";
        $media = $mediaModel->fetchAll($query);

        if($media){
            return $media[0]->getData();    
        }
        return false;
    }*/
	
}


?>