<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
		parent::__construct();
	}

}


?>