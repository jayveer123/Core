<?php Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row
{
	protected $billingAdress;
	protected $shippingAddress;
	protected $items;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName("Order_Resource");
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
		$addressModel = Ccc::getModel('Order_Address');
		if(!$this->order_id)
		{
			return $addressModel;
		}
		if($this->billingAddress && !$reload)
		{
			return $this->billingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `order_address` WHERE `order_id` = {$this->order_id} AND `billing` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		
		$this->setBillingAddress($address);

		return $this->billingAddress;
	}

	public function setBillingAddress(Model_Order_Address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}

	public function getShippingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Order_Address');
		if(!$this->order_id)
		{
			return $addressModel;
		}
		if($this->shippingAddress && !$reload)
		{
			return $this->shippingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `order_address` WHERE `order_id` = {$this->order_id} AND `shipping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShippingAddress($address);

		return $this->shippingAddress;
	}

	public function setShippingAddress(Model_Order_Address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

	public function getItems($reload = false)
	{

		$itemModel = Ccc::getModel('Order_Item');
		if(!$this->order_id)
		{
			return $itemModel;
		}
		if($this->items && !$reload)
		{
			return $this->items;
		}
		$items=$itemModel->fetchAll("SELECT * FROM `order_item` WHERE `order_id` = {$this->order_id}");
		if(!$items)
		{
			return $itemModel;
		}
		$this->setItems($items);
		return $this->items;
	}

	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}
}

?>