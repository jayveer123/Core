<?php Ccc::loadClass('Model_Core_Row');

class Model_Cart extends Model_Core_Row
{
	protected $item;
	protected $items;
	protected $bilingAddress;
	protected $shipingAddress;
	protected $customer;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName("Cart_Resource");
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

	public function getBilingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Cart_Address');
		
		if(!$this->cart_id)
		{
			return $addressModel;
		}
		if($this->bilingAddress && !$reload)
		{
			return $this->bilingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cart_id` = {$this->cart_id} AND `billing` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBilingAddress($address);

		return $this->bilingAddress;
	}

	public function setBilingAddress(model_cart_address $address)
	{
		$this->bilingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Cart_Address');
		if(!$this->cart_id)
		{
			return $addressModel;
		}
		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cart_id` = {$this->cart_id} AND `shipping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShipingAddress($address);

		return $this->shipingAddress;
	}

	public function setShipingAddress(Model_Cart_Address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

	public function getItem($reload = false)
	{

		$itemModel = Ccc::getModel('Cart_Item');
		if(!$this->cart_id)
		{
			return $itemModel;
		}
		if($this->item && !$reload)
		{
			return $this->item;
		}
		$item=$itemModel->fetchRow("SELECT * FROM `cart_item` WHERE `cart_id` = {$this->cart_id}");
		if(!$item)
		{
			return $itemModel;
		}
		$this->setItem($item);

		return $this->item;
	}

	public function setItem(Model_Cart_Item $item)
	{
		$this->item = $item;
		return $this;
	}

	public function setCustomer(Model_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload = false)
	{

		$customerModel = Ccc::getModel('Customer');

		if(!$this->customer_id){
			return $customerModel;
		}
		if($this->customer && !$reload){
			return $this->customer;
		}

		$customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `id` = {$this->customer_id}");
		if(!$customer){
			return $customerModel;
		}
		$this->setCustomer($customer);
		return $this->customer;
	}

	public function getItems($reload = false)
	{

		$itemModel = Ccc::getModel('Cart_Item');
		if(!$this->cart_id)
		{
			return $itemModel;
		}
		if($this->items && !$reload)
		{
			return $this->items;
		}
		$items=$itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cart_id` = {$this->cart_id}");
		if(!$items)
		{
			return $itemModel;
		}
		$this->setItems($items);

		return $this->item;
	}

	public function setItems($items)
	{
		$this->item = $items;
		return $this;
	}

}

?>