<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Customer_Grid extends Block_Core_Grid {

	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}
	public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Customer Id',
		'type' => 'int',
		'key' =>'id'
		],'id');
		$this->addColumn([
		'title' => 'First Name',
		'type' => 'varchar',
		'key' =>'firstName'
		],'First Name');
		$this->addColumn([
		'title' => 'Last Name',
		'type' => 'varchar',
		'key' =>'lastName'
		],'Last Name');
		$this->addColumn([
		'title' => 'Email',
		'type' => 'varchar',
		'key' =>'email'
		],'Email');
		$this->addColumn([
		'title' => 'Mobile',
		'type' => 'int',
		'key' =>'mobile'
		],'Mobile');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'int',
		'key' =>'stetus'
		],'Status');
		$this->addColumn([
		'title' => 'Billing Address',
		'type' => 'varchar',
		'key' =>'billing'
		],'Billing Address');
		$this->addColumn([
		'title' => 'Created Date',
		'type' => 'datetime',
		'key' =>'createdDate'
		],'Created Date');
		$this->addColumn([
		'title' => 'Updated Date',
		'type' => 'datetime',
		'key' =>'updatedDate'
		],'Updated Date');
		$this->addAction([
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'customer' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'customer' 
        ],'Edit');
		$this->addAction([
            'title' => 'price','method' => 'getPriceUrl','class' => 'customer_price' 
        ],'Price');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        $this->setCollection($customers);
        return $this;
    }

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('customer');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT count('id') FROM `customer`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);

        $customers=$customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$this->getPager()->getStartLimit()} , {$this->getPager()->getEndLimit()}");
      
        if (!$customers) {
        	return null;
        }
        $customerColumn = [];
        foreach ($customers as $customer) {
            $billing = null;
            foreach($customer->getBillingAddress()->getData() as $key => $value){
                if($key != 'address_id' && $key != 'customer_id' && $key != 'billing'){
                    $billing .= $key." : ".$value."<br>";
                }
            }
            $customer->setData(['billing' => $billing]);
            array_push($customerColumn,$customer);
        }
              
        return $customerColumn;
    }
    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }
   
}


?>