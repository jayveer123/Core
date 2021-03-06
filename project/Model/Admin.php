<?php Ccc::loadClass('Model_Core_Row');


class Model_Admin extends Model_Core_Row
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Admin_Resource');
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

	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','admin',['id'=>$this->id]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','admin',['id'=>$this->id]);
	}

}

?>