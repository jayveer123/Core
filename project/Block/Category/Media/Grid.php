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
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $categoryId = $request->getRequest('id');

        $mediaModel = Ccc::getModel('Category_Media');
        $pagerModel = Ccc::getModel('Core_Pager');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(imageId) FROM `category_media`  WHERE `categoryId` = {$categoryId} ");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `category_media` WHERE `categoryId` = $categoryId LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $category = $mediaModel->fetchAll($query);
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