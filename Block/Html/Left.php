<?php 

class Block_Html_Left extends Block_Core_Layout
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/Left.phtml');
	}
	
}

?>