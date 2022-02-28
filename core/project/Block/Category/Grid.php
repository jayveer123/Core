<?php 

Ccc::loadClass('Block_Core_Template');  

class Block_Category_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}
	public function getCategories()
	{
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM category ORDER BY `path` ASC");
		return $categories;
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

    public function getMedia($imageId)
    {
        $mediaModel=Ccc::getModel('Category_Media');
        $query="SELECT * FROM `category_media` WHERE `imageId` = {$imageId}";
        $media = $mediaModel->fetchAll($query);

        if($media){
            return $media[0]->getData();    
        }
        return false;
    }
	
}


?>