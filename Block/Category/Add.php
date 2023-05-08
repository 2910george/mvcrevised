<?php 

class Block_Category_Add extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/add.phtml');
		$this->getCategorys();
	}

	public function getCategorys()
	{
		$categorys = Ccc::getModel('category_row');
		return $categorys;
	}
}

?>