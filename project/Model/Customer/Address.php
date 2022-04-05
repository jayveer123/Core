<?php Ccc::loadClass('Model_Core_Row');
class Model_Customer_Address extends Model_Core_Row
{
	protected $customer;

	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
		parent::__construct();
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

        $customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `id` = {$this->customerId}");
        if(!$customer)
        {
            return $customerModel;
        }
        $this->setCustomer($customer);
        return $this->customer;
    }
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }


}
?>