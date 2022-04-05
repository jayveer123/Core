<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Config_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        $this->setCurrentTab('personal');
        parent::__construct();
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Personal Info',
            'block' => 'Config_Edit_Tabs_Personal',
            'url' => $this->getUrl(null,null,['tab' => 'personal'])
        ],'personal');
       
    }
}