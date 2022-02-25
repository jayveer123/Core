<?php 

require_once('Model/Core/Adapter.php'); 

class Model_Core_Table
{
	protected $tableName = null; 
	protected $primaryKey = null;
	

	public function getTableName()
	{	
		return $this->tableName;
	}
	public function setTableName($tableName)
	{	
		$this->tableName = $tableName;
		return $this;
	}
	public function getPrimaryKey()
	{	
		return $this->primaryKey;
	}
	public function setPrimaryKey($primaryKey)
	{	
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function fetchAll($query)
	{
		$adapter = new Model_Core_Adapter();
		$fetchAll=$adapter->fetchAll($query);
		
		return $fetchAll;
	}

	public function insert(array $data)
	{
		global $adapter;
	
		$prep = array();
		foreach($data as $key => $value ) {
	    	$prep[''.$key] ="'".$value."'";
		}
		$sth = ("INSERT INTO $this->tableName (" . implode(',',array_keys($data)) . 
			") VALUES ( ". implode(',', array_values($prep)) . ")");


		$insertId=$adapter->insert($sth);
		
		if(!$insertId)
		{
			throw new Exception("Error Processing Request", 1);
		}

		return $insertId;
	}

	public function delete($primaryKey = null,array $data = null)
	{
		$deleteQuery = "DELETE FROM $this->tableName WHERE $this->primaryKey=$primaryKey";
		global $adapter;
		$delete=$adapter->delete($deleteQuery);
		if(!$delete)
		{
			throw new Exception("Error Processing Request", 1);
		}
		return $delete;
	}

	public function fetchRow($query)
	{
		global $adapter;
		$fetchRow=$adapter->fetchAssos($query);
		if(!$fetchRow)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
		return $fetchRow;
	}

	public function update(array $data=null,$primaryKey=null,$coloumn=null)
	{
		global $adapter;
		$f="";
		foreach($data as $key => $value ) {
	    	$prep[''.$key] ="'".$value."'";
	    	$f.= $key."=".$prep[''.$key].",";
		}
		$final=rtrim($f,',');

		if(!$coloumn){
			$coloumn = $this->getPrimaryKey();
		}

		$updateQuery="UPDATE $this->tableName SET $final WHERE $this->tableName.$coloumn = $primaryKey";
	
		$update=$adapter->update($updateQuery);

		
		if(!$update)
		{
			throw new Exception("Error Processing Request", 1);	
		}
		return $update;
	}


}

?>