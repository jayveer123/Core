<?php 
Ccc::loadClass('Block_Core_Template');


class Block_Vendor_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getvendors()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendors = $vendorModel->fetchAll('SELECT * FROM vendor');
		return $vendors;
	}
}





?>