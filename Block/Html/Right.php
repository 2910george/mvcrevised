<?php 

class Block_Html_Right extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/Right.phtml');
	}
}

?>