<?php Ccc::loadClass('Controller_Core_Action'); ?>

<?php
class Controller_Vendor extends Controller_Core_Action{
	
	public function gridAction()
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}
	public function addAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel;
		Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor])->toHtml();
	}

	public function editAction()
	{
		
	}
	public function deleteAction()
	{
		
	}
	public function saveAction()
	{
		
	}
	public function errorAction()
	{
		echo "error";
	}
	


}


?>