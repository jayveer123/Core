<?php 

class Model_Core_Row
{
	protected $resourceClassName;
	protected $data = [];

	public function __construct()
	{
	}
	
	public function getResourceClassName()
	{
		return $this->resourceClassName;
	}

	public function setResourceClassName($resourceClassName)
	{
		$this->resourceClassName = $resourceClassName;
		return $this;
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
		return $this;
	}

	public function __get($name)
	{
		if (!array_key_exists($name, $this->data)) 
		{
			return null;
		}
		return $this->data[$name];	
	}

	public function __unset($key)
	{
		if(array_key_exists($key, $this->data))
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function resetData()
	{
		$this->data = [];
		return $this;
	}

	public function getTable()
	{
		return Ccc::getModel($this->getResourceClassName());
	}

	public function save($column = null,$tableName = null)
	{
		if(!$column){
			$column = $this->getTable()->getPrimaryKey();
		}
		if(array_key_exists($column, $this->data))
		{	
			$id = $this->data[$column];
			if(!$tableName){
				$result = $this->getTable()->update($this->data, [$column=>$id]);
			}	
			else{
				$result = $this->getTable()->update($this->data, [$column=>$id],$tableName);
			}
		}
		else
		{
			$result = $this->getTable()->insert($this->data);
		}
		return $result;
	}

	public function delete()
	{
		if(!array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
		{
			return false;
		}
		$key = $this->getTable()->getPrimaryKey();
		$value = $this->data[$this->getTable()->getPrimaryKey()];
		$result = $this->getTable()->delete([$key=>$value]);
		
		return $result;
	}

	public function load($id, $column = null)
	{
		
		if($column == null){
			$column = $this->getTable()->getPrimaryKey();
		}
		$tableName = $this->getTable()->getTableName();
		$query = "SELECT * FROM $tableName WHERE $column = $id";
		return $this->fetchRow($query);
	}

	public function fetchRow($query)
	{
		$result = $this->getTable()->fetchRow($query);
		if(!$result){
			return $result;
		}
		return (new $this())->setData($result);
	}

	// new fetchall method
	public function fetchAll($query)
	{
		$results = $this->getTable()->fetchAll($query);
		if(!$results)
		{
			return $results;
		}
		foreach ($results as &$result) 
		{
			$result = (new $this())->setData($result);
		}
		return $results;
	}

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = '1';
	const STATUS_DISABLED_LBL = '2';

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
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
}
