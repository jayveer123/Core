<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Admin_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
	}
	public function getAdmins()
	{
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $adminModel = Ccc::getModel('Admin');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `admin`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $query="SELECT * FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

		$admins = $adminModel->fetchAll($query);
		return $admins;
	}
	
}


?>