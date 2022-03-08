<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/Admin/update.php');
	}
	public function getAdmin()
   	{
   		return $this->getData('admin');
   	}
}
?>