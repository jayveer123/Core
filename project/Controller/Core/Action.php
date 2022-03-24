<?php
class Controller_Core_Action{

    protected $layout = null;
    protected $message = null;
    protected $cart = null;
    public $view = null;

    protected function setTitle($title)
    {
        $this->getLayout()->getHead()->setTitle($title);
    }
    public function getResponse()
    {
        return Ccc::getFront()->getResponse();
    }
    
    public function getLayout()
    {
        if(!$this->layout)
        {
            $this->setLayout(Ccc::getBlock('Core_Layout'));
        }
        return $this->layout;
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function randerLayout()
    {
        return $this->getLayout()->toHtml();
    }

    public function getAdapter()
    {
        global $Adapter;
        return $Adapter;
    }

    public function getRequest()
    {
        return Ccc::getFront()->getRequest();
    }

    public function redirect($c=null,$a=null,array $data = [],$reset = false)
    {
        $url = Ccc::getModel('Core_View')->getUrl($c,$a,$data,$reset);
        header("location: $url");
    }

    public function getMessage()
    {
        if(!$this->message){
            $this->setMessage(Ccc::getModel('Admin_Message'));
        }
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getCart()
    {
        if(!$this->cart){
            $this->setCart(Ccc::getModel('Admin_Cart'));
        }
        return $this->cart;
    }
    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }
}

?>