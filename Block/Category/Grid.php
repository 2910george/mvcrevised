<?php 

class Block_Category_Grid extends Block_Core_Layout
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/grid.phtml');
		$this->prepareData();
	}

	public function prepareData()
	{
		$pager = $this->getPager();
		$sql1 = "SELECT COUNT(`category_id`) FROM `category`";
		$total = Ccc::getModel('Core_Adapter')->fetchOne($sql1);
		$count = $total['COUNT(`category_id`)'];

		$pager->setTotalRecords($count)->calculate();

		$sql2 = "SELECT * FROM `category` LIMIT $pager->startLimit,$pager->recordPerPage";
		$category_row = Ccc::getModel('category_row');
		$categorys = $category_row->fetchAll($sql2);
		$this->setData(['categorys'=>$categorys]);
		return $this;


		/*$sql = "SELECT * FROM `category`";
		$category_row = Ccc::getModel('Category_Row');
		$categorys = $category_row->fetchAll($sql);
		$this->setData(['categorys'=>$categorys]);
		return $this;*/
	}
}

?>