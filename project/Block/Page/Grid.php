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

        $pageModel = Ccc::getModel('Page');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pageModel->fetchAll("SELECT count(id) AS ID FROM `page`");
        $pagerModel->execute($totalCount[0]->ID , $page);

        $query="SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

		$pages = $pageModel->fetchAll($query);
		return $pages;
	}
	
}


?>