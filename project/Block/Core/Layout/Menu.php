<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Core_Layout_Menu extends Block_Core_Template{

    public function __construct()
    {

        $this->setTemplate("view/core/layout/menu.php");
    }
    public function getLoginName()
    {

        $loginModel = Ccc::getModel('Admin_Login');
        if($loginModel->getLogin())
        {
            return true;          
        }
        else
        {
            return false;
        }
    }
    


}

?>