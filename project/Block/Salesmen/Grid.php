<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Salesmen_Grid extends Block_Core_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {

        $this->addColumn([
        'title' => 'Salesmen Id',
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
        'key' =>'status'
        ],'Status');
        $this->addColumn([
        'title' => 'Margin',
        'type' => 'float',
        'key' =>'margin'
        ],'Margin');
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
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'salesmen' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'salesmen' ],'Delete');
        $this->addAction(['title' => 'Manage','method' => 'getCustomerUrl','class' => 'salesmen_SalesmenCustomer' ],'Customer');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $salesmens = $this->getSalesmens();
        $this->setCollection($salesmens);
        return $this;
    }
    

    public function getSalesmens()
    {
        $salesmenModel = Ccc::getModel('Salesmen');
        $request = Ccc::getModel('Core_Request');

        $this->setPager(Ccc::getModel('Core_Pager'));

        $p = $request->getRequest('p',1);
        $ppr = $request->getRequest('ppr',20);

        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('id') FROM `salesmen`");
        $this->getPager()->execute($totalCount,$p,$ppr);
        $salesmens = $salesmenModel->fetchAll("SELECT * FROM `salesmen` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $salesmenColumn = [];
        if($salesmens){
            foreach ($salesmens as $salesmen) 
            {
                array_push($salesmenColumn,$salesmen);
            }
        }
        return $salesmenColumn;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
    
}


?>