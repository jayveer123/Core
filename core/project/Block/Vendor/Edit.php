<?php 
Ccc::loadClass('Block_Core_Template');


class Block_Vendor_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		$this->setTemplate('view/vendor/update.php');
	}

	public function getVendor()
	{
		return $this->getData('vendor');
	}
	public function getAddress()
   	{
   		$address = $this->getData('address');
   		if($address == null){
            return Ccc::getModel('Vendor_Address');
        }
        return $address;
   	}
}

?>