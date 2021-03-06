<?php 
Ccc::loadClass('Model_Core_Row');

class Model_Salesmen extends Model_Core_Row{

	protected $customer;

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Salesmen_Resource');
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

	public function getCustomer($reload = false)
    {
        $customerModel = Ccc::getModel('Customer');
        if(!$this->customerId)
        {
            return $customerModel;
        }
        if($this->customer && !$reload)
        {
            return $this->customer;
        }
        $customer=$customerModel->fetchRow("SELECT * FROM `customer` WHERE `id` = {$this->customerId}");
        if(!$customer)
        {
            return $customerModel;
        }
        $this->setCustomer($customer);
        return $customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','customer',['id'=>$this->customerId]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','customer',['id'=>$this->customerId]);
	}

	public function getCustomerUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('grid','salesmen_salesmenCustomer',['id'=>$this->customerId]);
	}
}




?>