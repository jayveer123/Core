<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
	protected $billingAddress;
	protected $shippingAddress;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
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
	public function getBillingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		
		if(!$this->id)
		{
			return $addressModel;
		}
		if($this->billingAddress && !$reload)
		{
			return $this->billingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customer_id` = {$this->id} AND `billing` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBillingAddress($address);

		return $address;
	}

	public function setBillingAddress(model_customer_address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}
	public function getShippingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Customer_Address');
		if(!$this->id)
		{
			return $addressModel;
		}
		if($this->shippingAddress && !$reload)
		{
			return $this->shippingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customer_id` = {$this->id} AND `shipping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShippingAddress($address);

		return $address;
	}

	public function setShippingAddress(model_customer_address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

}


?>