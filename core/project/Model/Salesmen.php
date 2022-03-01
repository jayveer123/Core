<?php 
Ccc::loadClass('Model_Core_Row');

class Model_Salesmen extends Model_Core_Row{
	public function __construct()
	{
		$this->setResourceClassName('Salesmen_Resource');
		parent::__construct();
	}
}




?>