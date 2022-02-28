<?php
Ccc::loadClass('Block_Core_Template');
class Block_Category_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/category/update.php');
	}
	
	public function getCategories()
   	{
   		$categoryModel = Ccc::getModel('category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $categories;
   	}
    public function getCategory()
    {
        return $this->getData('category');
    }
   	public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $paths = explode("/",$path);
        foreach ($paths as $path) {
            $load = Ccc::getModel('Category');
            $category = $load->load($path);
            if($path != $categoryId){
                $finalPath .= $category->c_name." / ";
            }else{
                $finalPath .= $category->c_name;
            }
        }
        return $finalPath;
    }
}
?>