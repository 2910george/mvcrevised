<?php 

class Block_Product_Grid extends Block_Core_Layout
{
	public $column = [];
	public $action = [];

	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/grid.phtml');
		$this->prepareData();
		//$this->prepareAction();
		//$this->prepareColumn();
	}

	public function prepareData()
	{
		$pager = $this->getPager();
		$sql1 = "SELECT COUNT(`product_id`) FROM `product` ORDER BY `product_id` DESC ";
		$total = Ccc::getModel('Core_Adapter')->fetchOne($sql1);
		
		$count = $total['COUNT(`product_id`)'];

		$pager->setTotalRecords($count)->calculate();

		$sql2 = "SELECT * FROM `product` LIMIT $pager->startLimit,$pager->recordPerPage";
		$product_row = Ccc::getModel('product_row');
		$products = $product_row->fetchAll($sql2);
		$this->setData(['products'=>$products]);
		return $this;
		
	}

	public function _prepareColumns()
	{
		$this->addColumn('product_id',['title'=>'product_id']);
		$this->addColumn('name',['title'=>'product_id']);
		$this->addColumn('sku',['title'=>'product_id']);
		$this->addColumn('cost',['title'=>'product_id']);
		$this->addColumn('price',['title'=>'product_id']);
		$this->addColumn('quantity',['title'=>'product_id']);
		$this->addColumn('description',['title'=>'product_id']);
		$this->addColumn('inserted_at',['title'=>'product_id']);

		return parent::_prepareColumns();
	}

	public function _prepareActions()
	{
		$this->addAction('edit',['title' => 'EDIT']);
		$this->addAction('delete',['title' => 'DELETE']);
	}

	public function _prepareButtons()
	{
		$this->addButtons('cancel',['title' => 'CANCEL']);
		$this->addButtons('add',['title' => 'ADD']);
	}

	public function getCount()
	{
		$sql = "SELECT COUNT('product_id') FROM `product`";
		$count = Ccc::getModel('product')->fetchOne($sql);
		return $count;
	}
}
?>