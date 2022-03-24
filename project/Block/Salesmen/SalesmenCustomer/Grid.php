<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesmen_SalesmenCustomer_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesmen/customer/grid.php");
    }
    public function getAvailableCustomers()
    {
        $request = Ccc::getFront()->getRequest();
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');

        $customerModel = Ccc::getModel('Customer');
        $pagerModel = Ccc::getModel('Core_Pager');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(id) FROM `customer` WHERE `salesmen_id` is null AND `stetus` = '1'");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmen_id` is null AND `stetus` = '1' LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $customers;
    }
    public function getCustomers()
    {
        $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmen_id` = '$salesmanId' AND `stetus` = '1' ");
        return $customers;
    }

    public function getSalesmenId()
    {
        return Ccc::getFront()->getRequest()->getRequest('id');
    }
}