<?php Ccc::loadClass('Model_Core_Row');
class Model_Category_Media extends Model_Core_Row
{
	protected $mediaPath = 'Media/Category/';
	protected $category;
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		parent::__construct();
	}
	public function getCategory($reload = false)
	{
		$categoryModel = Ccc::getModel('Category'); 	
		if(!$this->id)
		{
			return $categoryModel;
		}
		if($this->category && !$reload)
		{
			return $this->category;
		}
		$category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `id` = {$this->id}");
		if(!$category)
		{
			return $categoryModel;
		}

		$this->setCategory($category);

		return $this->category;
	}

	public function setCategory($category)
	{
		$this->category =$category;
		return $this;
	}
	public function getImgPath()
    {
        return Ccc::getBaseUrl($this->mediaPath.$this->imageName);
    }
}
?>