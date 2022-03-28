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
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $salesmenModel = Ccc::getModel('Salesmen');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `salesmen`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `salesmen` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

        $salesmens = $salesmenModel->fetchAll($query);
        return $salesmens;
    }
}





?>