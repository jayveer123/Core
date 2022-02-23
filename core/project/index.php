<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu</title>
</head>
<body>
<table border="1" align="center">
	<tr>
		<td><a href="index.php?c=admin&a=grid">Admin</a></td>
		<td><a href="index.php?c=product&a=grid">Product</a></td>
		<td><a href="index.php?c=customer&a=grid">Customer</a></td>
		<td><a href="index.php?c=category&a=grid">Category</a></td>
	</tr>
</table>
</body>
</html>


<?php require_once('Model/Core/Adapter.php');  ?>
<?php

$adapter = new Model_Core_Adapter();

class Ccc
{
	public static $front = null;
	public static function loadFile($path)
	{
		require_once($path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function setFront($front)
	{
		self::$front = $front;
	}
	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return new $className();
	}
	public static function getBlock($className)
	{
		$className = 'Block_'.$className;
		self::loadClass($className);
		return new $className();
	}
	public static function init()
	{
		self::getFront()->init();
	}
}

Ccc::init();


?>

