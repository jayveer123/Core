<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Core_Layout_Menu extends Block_Core_Template{

    public function __construct()
    {

        $this->setTemplate("view/core/layout/menu.php");
    }
    public function getLoginName()
    {

        $messageModel = Ccc::getModel('Admin_Message');
        $messages = $messageModel->getSession()->getNamespace();

        if($_SESSION[$messages])
        {
            $email = $_SESSION[$messages]['login']['loginId'];
      
            if($email){
                return true;   
            }
            return null; 
        }
        else
        {
            return null;
        }
    }


}

?>