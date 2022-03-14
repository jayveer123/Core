<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	
	public function getProducts()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $productModel = Ccc::getModel('Product');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `product`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $query="SELECT * FROM `product` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

        $products = $productModel->fetchAll($query);
        return $products;
    }
	
	public function getMedia($imageId)
	{
		$mediaModel=Ccc::getModel('Product_Media');
		$query="SELECT * FROM `product_media` WHERE `imageId` = {$imageId}";
		$media = $mediaModel->fetchAll($query);

		if($media){
			return $media[0]->getData();	
		}
		return false;
		
	}
	
}


?>