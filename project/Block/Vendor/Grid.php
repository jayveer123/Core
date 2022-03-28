<?php 
Ccc::loadClass('Block_Core_Template');


class Block_Vendor_Grid extends Block_Core_Template
{
	
	function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}
	public function getVendors()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $vendorModel = Ccc::getModel('Vendor');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `vendor`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `vendor` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

        $vendors = $vendorModel->fetchAll($query);
        return $vendors;
    }
}

?>