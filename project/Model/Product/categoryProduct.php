<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_categoryProduct extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Product_categoryProduct_Resource');
		parent::__construct();
	}

}

?>