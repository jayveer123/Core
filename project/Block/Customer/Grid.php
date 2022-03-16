<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Customer_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}
	public function getCustomers()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $customerModel = Ccc::getModel('customer');
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) AS ID FROM `customer`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $query="SELECT * FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";

        $customers = $customerModel->fetchAll($query);
        return $customers;
    }
	public function getAddresses()
	{
		$addressModel = Ccc::getModel('Customer_Address');
		$addresses = $addressModel->fetchAll("SELECT * FROM customer_address");
		return $addresses;	

	}
}


?>