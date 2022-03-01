<?php 
Ccc::loadClass('Block_Core_Template');


class Block_Salesmen_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		$this->setTemplate('view/salesmen/grid.php');
	}

	public function getSalesmens()
	{
		$salesmenModel = Ccc::getModel('Salesmen');
		$salesmens = $salesmenModel->fetchAll('SELECT * FROM salesmen');
		return $salesmens;
	}
}





?>