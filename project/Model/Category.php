<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Category_Resource');
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

	public function savePath($categoryData)
	{
		if(!array_key_exists('parent_id',$categoryData->getData())){
			$this->path = $this->id;
			$result = $this->save();

			throw new Exception("This is root category", 1);
		}

		$request = Ccc::getFront()->getRequest();
		if($request->getRequest('id')){
			$categoryId = $request->getRequest('id');
			$allPath = $this->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$categoryId%' ");
			foreach ($allPath as $path) {
				$finalPath = explode('/',$path->path);
				foreach ($finalPath as $subPath) {
					if($subPath == $categoryId){
						if(count($finalPath) != 1){
							array_shift($finalPath);
						}    
						break;
					}
					array_shift($finalPath);
				}
				if($path->parent_id){
					$parentPath = $this->load($path->parent_id);
					$path->path = $parentPath->path ."/".implode('/',$finalPath);
				}
				else{
					$path->path = $path->id;
				}
				$result = $path->save();
			}		
		}
		else{
			$categoryData->id = $this->id;
			$parentPath = $this->load($categoryData->parent_id);
			$categoryData->path = $parentPath->path."/". $this->id;
			$result = $categoryData->save();
		}
	}

	

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->media)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `categoryId` = {$this->categoryId}");
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

}

?>