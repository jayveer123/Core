<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Config_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
	}
	public function getConfigs()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $configModel = Ccc::getModel('config');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `config`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `config` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

        $configs = $configModel->fetchAll($query);
        return $configs;
    }
	
}


?>