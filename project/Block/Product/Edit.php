<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/product/update.php');
	}
	public function getProduct()
   	{
   		return $this->getData('product');
   	}
   	public function getCategories()
    {
        $category = Ccc::getModel('Category');
        $categories = $category->fetchAll("SELECT * FROM `category` WHERE `c_stetus` = 1 ");
        if(!$categories){
            return null;
        }
        return $categories;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $singlepath) {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `id` = '$singlepath' ");
            if($singlepath != $categoryId){
                $finalPath .= $category->c_name ."=>";
            }else{
                $finalPath .= $category->c_name;
            }
        }
        return $finalPath;
    }

    public function selected($categoryId)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $categoryProductModel = Ccc::getModel('Product_CategoryProduct');
        $select = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$productId' AND `category_id` = '$categoryId'");
        if($select){
            return 'checked';
        }
        return null;
    }
}
?>