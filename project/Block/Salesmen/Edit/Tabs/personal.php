<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Salesmen_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{ 
    public function __construct()
    {
        $this->setTemplate('view/salesmen/edit/tabs/personal.php');
    }

    public function getSalesmen()
    {
        return Ccc::getRegistry('salesmen');
    }
}