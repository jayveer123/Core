<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	public function getProducts()
	{
		$query = "SELECT p.*,b.imageName as base,t.imageName as thumb,s.imageName as small FROM `product` as p 
        left join productmedia as b ON p.`id` = b.`productId` AND b.base = 1
        left join productmedia as t ON p.`id` = t.`productId` AND t.thumb = 1
        left join productmedia as s ON p.`id` = s.`productId` AND s.small = 1";
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll($query);
		return $products;	

	}
	
}


?>