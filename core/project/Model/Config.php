<?php Ccc::loadClass('Model_Core_Row');


class Model_Config extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Config_Resource');
		parent::__construct();
	}

}

?>