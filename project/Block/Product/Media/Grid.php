<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $productModel = Ccc::getModel('Product_Media');
        $product = $productModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = $productId ");
        return $product;
    }
    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $product_id = $request->getRequest('id');
        $productModel = Ccc::getModel('Product');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
    }
}

?>