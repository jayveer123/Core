<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $categoryId = $request->getRequest('id');
        $categoryModel = Ccc::getModel('Category_Media');
        $category = $categoryModel->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = $categoryId ");
        return $category;
    }
    public function selected($imageId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $category_id = $request->getRequest('id');
        
        $categoryModel = Ccc::getModel('Category');
        $select = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `$column` = '$imageId'");

        if($select){
            return 'checked';
        }
        return false;
    }
}

?>