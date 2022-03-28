<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Cart_Grid extends Block_Core_Template
{
    protected $pager = null;
    
    public function __construct()
    {
        $this->setTemplate("view/cart/grid.php");
    }

    public function getCart()
    {
        $cartModel = Ccc::getModel('Cart');

        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('cart_id') FROM `cart`");

        $pagerModel->execute($totalCount, $page, $ppr);

        $cart = $cartModel->fetchAll("SELECT * FROM `cart` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $cart;
    }

    public function getOrders()
    {
        $orderModel = Ccc::getModel("Order");

        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr', 20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;

        $totalCount = $orderModel->fetchRow("SELECT COUNT('order_id') AS id FROM `order_data`");

        $pagerModel->execute($totalCount->id,$page,$ppr);

        $orders = $orderModel->fetchAll("SELECT * FROM `order_data` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $orders;
    }
}

?>