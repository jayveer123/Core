<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Page_Grid extends Block_Core_Template {

	public $pager;

	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}
	public function getPages()
	{
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $pageModel = Ccc::getModel('Page');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `page`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

		$pages = $pageModel->fetchAll($query);
		return $pages;
	}
	
}


?>