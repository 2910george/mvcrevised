<?php 

require_once 'Controller/Core/Action.php';
error_reporting(E_ALL);


spl_autoload_register(function($className)
{
	$classPath = str_replace('_','/',$className);
	require_once "{$classPath}.php";
}
);

class Ccc extends Controller_Core_Action
{
	public static function init()
	{
		$front = new Controller_Core_Front();
		$front->init();
	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		return new $className();
	}

	public static function getSingleton($className)
	{
		$className = 'Model_'.$className();
		if(array_key_exists($className,$GLOBALS))
		{
			return $GLOBALS[$className];
		}
		$GLOBALS[$className] = (new className());
		return $GLOBALS[$className]; 
	}

	public function setRegister($key,$value)
	{
		$GLOBALS[$key] = $value;
	}

	public function getReister()
	{
		if(array_key_exists($key,$GLOBALS))
		{
			$GLOBALS[$key];
		}
		return null;
	}

	public function getBaseDir($subDir = null)
	{
		$dir = getcwd();
		if($subDir)
		{
			return $dir.$subDir;
		}
		return $dir;
	}

}

if(!(Ccc::getModel('Core_Request')->getParam('c')) || !(Ccc::getModel('Core_Request')->getParam('a')))
	{
		header('Location:http://localhost/mvc/index.php?c=product&a=grid');
		exit();
	}

Ccc::init();



?>