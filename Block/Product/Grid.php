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
		$sql = "SELECT * FROM `product` ORDER BY `product_id` DESC";
		$product_row = Ccc::getModel('product_row');
		$products = $product_row->fetchAll($sql);
		$this->setData(['products'=>$products]);
		return $this;
	}

/*	public function setColumn(array $column)
	{
		$this->column = $column;
	}

	public function getColumn()
	{
		return $this->column;
	}

	public function addColumn($key,$value)
	{
		$this->column[$key] = $value;
	}
*/
}
?>