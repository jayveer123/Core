<?php 

class Model_Core_Request
{
	public function getPost($key = null,$value = null)
	{
		if(!$this->isPost())
		{
			return null;	
		}
		if($key == null)
		{
			return $_POST;
		}
		if(!array_key_exists($key,$_POST))
		{
			return $value;
		}
		return $_POST[$key];
	}
	public function getFile()
    {
        return $_FILES;
    }
	
	public function getRequest($key = null,$value = null)
	{
		if($key == null)
		{
			return $_REQUEST;
		}
		if(!array_key_exists($key,$_REQUEST))
		{

			return $value;
		}
		return $_REQUEST[$key];
	}
		

	public function ispost()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			return true;
		}
		return false;
	}

	public function getActionName()
	{
		return $this->getRequest('a','grid').'Action';
	}

	public function getControllerName()
	{
		return $this->getRequest('c','customer');
	}
}


$r = new Model_Core_Request()

?>