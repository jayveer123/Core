<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	protected $media;
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';
	
	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
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


	public function getBase()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->base)
		{
			return null;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `imageId` = {$this->base}");
		if(!$base)
		{
			return $mediaModel;
		}

		return $base;
	}
	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->small)
		{
			return null;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `imageId` = {$this->small}");
		if(!$small)
		{
			return $mediaModel;
		}

		return $small;
	}
	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		$thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `imageId` = {$this->thumb}");
		if(!$thumb)
		{
			return $mediaModel;
		}

		return $thumb;
	}

	
	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->id)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = {$this->id}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);
		return $this->media;
	}
	public function setMedia($media)
	{
		$this->media =$media;
		return $this;
	}
	public function saveCategories(array $categoryIds)
	{
		$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$this->id' ");	
		
		
		foreach($categoryProduct as $category)
		{
			if(!in_array($category->category_id, $categoryIds['exists'])){
				$categoryProductModel->load($category->entity_id)->delete();
			}
		}
		foreach($categoryIds['new'] as $categoryId)
		{
			$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
			$categoryProductModel->product_id = $this->id;
			$categoryProductModel->category_id = $categoryId;
			$categoryProductModel->save();
		}
	}
	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','Category',['id'=>$this->id]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','Category',['id'=>$this->id]);
	}

	public function getMediaUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('grid','Category_Media',['id'=>$this->id]);
	}	

}


?>