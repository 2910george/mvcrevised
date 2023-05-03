<?php 
require_once 'Controller/Core/Action.php';

define("CD",getcwd());
define("DS",DIRECTORY_SEPARATOR);
class Controller_Core_Front 
{
	public function init()
	{
		$action = new Controller_Core_Action();
		$request = $action->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName()."Action";

		$str_replace = str_replace('_',' ',$controller);
		$replace = str_replace(' ','_',ucwords($str_replace));
		$className = "Controller_".ucwords($replace);
		$fileImplement = str_replace('_',DS,$className).'.php';
		$this->filePath($fileImplement);
		$actionName = new $className();
		$actionName->$action();

	}
	
	public function filePath($path)
	{
		require_once CD.DS.$path;
	}
}

?>