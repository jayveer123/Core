<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	public function getProducts()
	{
		$query = "SELECT * FROM product";
		$productModel = Ccc::getModel('Product');
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