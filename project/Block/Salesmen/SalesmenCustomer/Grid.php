<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesmen_SalesmenCustomer_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesmen/customer/grid.php");
    }
    public function getCustomers()
    {
        $request = Ccc::getFront()->getRequest();
    
        $salesmenId = $request->getRequest('id');

        $customerModel = Ccc::getModel('Customer');
        
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE (`salesmen_id` is null OR `salesmen_id` = '$salesmenId') AND `stetus` = '1'");

        return $customers;
    }

    public function getSalesmenId()
    {
        return Ccc::getFront()->getRequest()->getRequest('id');
    }

    public function selected($customerId)
    {
        $request = Ccc::getFront()->getRequest();
        $salesmenId = $request->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $select = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `id` = '$customerId' AND `salesmen_id` = '$salesmenId'");
        if($select)
        {
            return 'checked disabled';
        }
        return null;
    }
}