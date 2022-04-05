<?php 
Ccc::loadClass('Model_Core_Row');

class Model_Vendor extends Model_Core_Row{

	protected $address = null;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	function __construct(){
		$this->setResourceClassName('Vendor_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses)) {
			return $statuses[$key];
		}
		return self::STATUS_DEFAULT;
	}
	public function getAddress($relode = false)
	{
		
		$addressModel = Ccc::getModel('Vendor_Address');
		if(!$this->id){
			return $addressModel;
		}
		if($this->address && !$relode){
			return $this->address;
		}

		$address = $addressModel->fetchRow("SELECT * FROM `vendor_address` WHERE `vendor_id` = {$this->id}");

		if(!$address)
		{
			return $addressModel;
		}
		$this->setAddress($address);

		return $this->address;
	}
	public function setAddress($address)
	{
		$this->address =$address;
		return $this;
	}

	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','vendor',['id'=>$this->vendorId]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','vendor',['id'=>$this->vendorId]);
	}
}

?>