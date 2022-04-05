<?php 
Ccc::loadClass('Block_Core_Grid'); 


class Block_Product_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
        $this->prepareCollections();
	}
    public function prepareCollections()
    {
         $this->addColumn([
        'title' => 'Product Id',
        'type' => 'int',
        'key' =>'id'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'p_name'
        ],'Name');

         $this->addColumn([
        'title' => 'Base Image',
        'type' => 'int',
        'key' =>'base'
        ],'Base Image');

        $this->addColumn([
        'title' => 'Thumb Image',
        'type' => 'int',
        'key' =>'thumb'
        ],'Thumb Image');

        $this->addColumn([
        'title' => 'Small Image',
        'type' => 'int',
        'key' =>'small'
        ],'Small Image');
        
        $this->addColumn([
        'title' => 'Price',
        'type' => 'int',
        'key' =>'p_price'
        ],'Price');
        $this->addColumn([
        'title' => 'TAX',
        'type' => 'int',
        'key' =>'tax'
        ],'TAX');
        $this->addColumn([
        'title' => 'Discount',
        'type' => 'int',
        'key' =>'discount'
        ],'Discount');
        $this->addColumn([
        'title' => 'MSP',
        'type' => 'int',
        'key' =>'msp'
        ],'MSP');
        $this->addColumn([
        'title' => 'Cost Price',
        'type' => 'int',
        'key' =>'cost_price'
        ],'Cost Price');
        $this->addColumn([
        'title' => 'Quantity',
        'type' => 'int',
        'key' =>'p_qun'
        ],'Quantity');
        $this->addColumn([
        'title' => 'Status',
        'type' => 'int',
        'key' =>'stetus'
        ],'Status');
        
        $this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'category'
        ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'product' ],'Delete');
        $this->prepareCollectionContent();  
    }
    public function prepareCollectionContent()
    {
        $products = $this->getProducts();
        $this->setCollection($products);
        return $this;
    }

	public function getProducts()
    {   
        $productModel = Ccc::getModel('Product');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $p = $request->getRequest('p',1);
        $ppr = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('id') FROM `product`");
        $this->getPager()->execute($totalCount,$p,$ppr);
        $products = $productModel->fetchAll("SELECT * FROM `product`  LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $productColumn = [];
        if(!$products){
            return null;
        }
        foreach ($products as $product) 
        {
            array_push($productColumn,$product);
        }        
        return $productColumn;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
}





?>