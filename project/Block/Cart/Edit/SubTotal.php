<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_SubTotal extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/subTotal.php");
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

    public function getItems()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        if(!Ccc::getModel('Admin_Cart')->getCart()){
            return null;
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart()['cart_id'];
        if($cartId){
            $items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cart_id` = {$cartId} ");
            return $items;
        }
        return null;
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

    public function getTax($cartId)
    {
        $itemModel = Ccc::getModel('Cart_Item');
        if($cartId){
            $tax =$itemModel->fetchRow("SELECT sum(ci.itemTotal * p.tax / 100) as tax FROM `cart_item` as ci JOIN `product` as p ON ci.product_id = p.id WHERE ci.cart_id = {$cartId}");
            
            return $tax->tax;   
        }
        return null;
    }
}
