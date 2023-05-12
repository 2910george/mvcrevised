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

	}

	public function getcount()
	{
		$sql = "SELECT COUNT(`customer_id`) FROM `customer`";
		$count = Ccc::getModel('Category_Row');
		return $count;
	}

	public function _prepareColumns()
	{
		$this->addColumn('category_id',['title'=>'category_id']);
		$this->addColumn('name',['title'=>'name']);
		$this->addColumn('description',['title'=>'description']);
		$this->addColumn('status',['title'=>'status']);
		
		return parent::_prepareColumns();
	}

	public function _prepareActions()
	{
		$this->addAction('edit',['title'=>'EDIT']);
		$this->addAction('delete',['title'=>'DELETE']);

		return parent::_prepareActions();
	}

	public function _prepareButtons()
	{
		$this->addButton('cancel',['title'=>'CANCEL']);
		$this->addButton('add',['title'=>'ADD']);

		return parent::_prepareButtons();
	}


}

?>