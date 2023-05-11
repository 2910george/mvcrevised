<?php 

class Block_Html_Message extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/Message.phtml');
	}
}


?>