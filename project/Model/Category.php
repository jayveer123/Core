<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
	protected $media;

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

			return true;
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

	public function getPath()
    {
		$categoryId = $this->id;
		$path = $this->path;
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `id` = '$path1' ");
            if($path1 != $categoryId){
                $finalPath .= $category->c_name ."=>";
            }else{
                $finalPath .= $category->c_name;
            }
        }
        return $finalPath;
    }

	public function getBase()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->base)
		{
			return null;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `imageId` = {$this->base}");
		if(!$base)
		{
			return $mediaModel;
		}

		return $base;
	}
	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->small)
		{
			return null;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `imageId` = {$this->small}");
		if(!$small)
		{
			return $mediaModel;
		}

		return $small;
	}
	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		$thumb = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `imageId` = {$this->thumb}");
		if(!$thumb)
		{
			return $mediaModel;
		}

		return $thumb;
	}

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->id)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = {$this->id}");
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