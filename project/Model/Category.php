<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Category_Resource');
		parent::__construct();
	}

}

?>