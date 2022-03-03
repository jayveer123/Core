<?php
Ccc::loadClass('Model_Core_View');
class Controller_Core_Action{

    protected $layout = null;
    public $view = null;
    public function getLayout()
    {
        if(!$this->layout){
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

    public function redirect($url)
    {
        header("location: $url");
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }
    public function getView()
    {
        if (!$this->view)
        {
            $this->setView(new Model_Core_View());
        }
        return $this->view;
    }
}

?>