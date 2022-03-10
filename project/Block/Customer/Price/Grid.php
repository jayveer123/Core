<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Price_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/price/grid.php");
    }

    public function getProducts()
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $productModel = Ccc::getModel('product');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `id` = {$customerId} AND `salesmen_id` IS NOT NULL");
        if(!$customer){
            return $productModel->getData();
        }
        $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `p_stetus` = '1' ");
        return $products;
    }

    public function getDiscount($productId)
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $customerPriceModel = Ccc::getModel('Customer_Price');
        $discount = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `product_id` = '$productId' AND `customer_id` = '$customerId' ");
        if(!$discount){
            return null;
        }
        return $discount[0]->discount;
    }

    public function getSalesmanPrice($productId)
    {
        error_reporting(0);
        
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        
        $productModel = Ccc::getModel('product');
        $salesmanModel = Ccc::getModel('salesmen');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `id` = {$customerId}");
        if($customer){

            $salesmen = $salesmanModel->fetchAll("SELECT * FROM `salesmen` WHERE `id` = {$customer[0]->salesmen_id}");

            if($salesmen){

                $product = $productModel->fetchAll("SELECT * FROM `product` WHERE `id` = {$productId}");
                return $product[0]->p_price - $product[0]->p_price*$salesmen[0]->margin/100;
            }
        }
    }
    

}

?>