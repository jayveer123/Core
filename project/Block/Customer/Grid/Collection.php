<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Customer_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {

        $this->setCurrentCollection('personal');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'title' => 'Customer Info',
            'block' => 'Customer_Grid_Collections_Personal',
            'header' => ['Id','First Name','Last Name','Email','Mobile','Stetus','CreatedDate','UpdatedDate','Address','Postal Code','City','State','Country'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();
    }
    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        $array=[];
        if (!$customers) {
            return null;
        }
        foreach($customers as $customer)
        {
           $customer->stetus = $customer->getStatus($customer->stetus);
           $customer->setData(['billing'=>$customer->getBillingAddress()]);
        }
        foreach($customer->getData() as $key => $value)
        {
            $array1[]=$value;
            if($key == 'billing')
            {
                //$address = [];
                foreach ($value->getData() as $data) 
                {   
                    array_push($array1,$data);                      
                }
            }
            
        }
        unset($array1[8]);
        unset($array1[16]);
        unset($array1[17]);
        unset($array1[9]);
        unset($array1[10]);
        array_push($array,$array1);
        $this->setColumns($array);
        return $this;
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
        $customers=$customerModel->fetchAll("SELECT `id`,`firstName`,`lastName`,`email`,`mobile`,`stetus`,`createdDate`,`updatedDate` FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");

        $this->setPagerModel($pagerModel);
        return $customers;
    }

}