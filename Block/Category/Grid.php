<?php 

class Block_Category_Grid extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Category/grid.phtml');
		$this->prepareData();
	}

	public function prepareData()
	{
		$sql = "SELECT * FROM `category`";
		$category = Ccc::getModel('Category_Row');
		$categorys = $category->fetchAll($sql);
		$this->setData(['categorys'=>$categorys]);
		return $this;
	}
}


?>