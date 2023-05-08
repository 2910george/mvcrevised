<?php 

class Block_Html_Content extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/Content.phtml');
	}
}
?>