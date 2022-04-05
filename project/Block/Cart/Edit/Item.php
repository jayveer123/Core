<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_Item extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/item.php");
    }

    public function getCart()
    {
        if(!Ccc::getModel('Admin_Cart')->getCart()){
            return Ccc::getModel('Cart');
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart()['cart_id'];
        $cartModel = Ccc::getModel('Cart')->load($cartId);
        return $cartModel;
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('Product');
        if(!Ccc::getModel('Admin_Cart')->getCart()){
            return null;
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart()['cart_id'];
        if($cartId){
            $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `id` NOT IN (SELECT `product_id` FROM `cart_item` WHERE `cart_id` = $cartId)");
            return $products;
        }
        else{
            $products = $productModel->fetchAll("SELECT * FROM `product`");
            return $products;
        }
    }

    public function getTotal()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        if(!Ccc::getModel('Admin_Cart')->getCart()){
            return null;
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart()['cart_id'];
        if($cartId){
            $items = $itemModel->fetchRow("SELECT sum(`itemTotal`) AS `sum` FROM `cart_item` WHERE `cart_id`={$cartId}");
            return $items->sum;
        }
        return null;
    }
}
