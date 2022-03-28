<?php 
Ccc::loadClass('Block_Core_Template');


class Block_Salesmen_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		$this->setTemplate('view/salesmen/update.php');
	}

	public function getSalesmen()
	{
		return $this->getData('salesmen');
	}
}





?>