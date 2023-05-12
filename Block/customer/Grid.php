<?php 

class Block_Customer_Grid  extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/grid.phtml');
		$this->prepareData();
	}

	public function prepareData()
	{
		
		$pager = $this->getPager();
		$sql1 = "SELECT COUNT(`customer_id`) FROM `customer`";
		$total = Ccc::getModel('Core_Adapter')->fetchOne($sql1);
		$count = $total['COUNT(`customer_id`)'];

		$pager->setTotalRecords($count)->calculate();

		$sql2 = "SELECT * FROM `customer` JOIN `customer_address` ON customer.customer_id=customer_address.customer_id  LIMIT $pager->startLimit,$pager->recordPerPage";
		$customer_row = Ccc::getModel('customer_row');
		$customers = $customer_row->fetchAll($sql2);
		$this->setData(['customers'=>$customers]);
		return $this;

	}

	public function count()
	{
		$sql = "SELECT COUNT(`customer_id`) FROM `customer`";
		$count = Ccc::getModel('Customer_Row')->fetchOne($sql);
		return $count;
	}

	public function _prepareActions()
	{
		$this->addAction('edit',['title'=>'EDIT']);
		$this->addAction('delete',['title'=>'DELETE']);

		return parent::_prepareActions();
	}

	public function _prepareColumns()
	{
		$this->addColumn('customer_id',['title'=>'customer_id']);
		$this->addColumn('first_name',['title'=>'first_name']);
		$this->addColumn('last_name',['title'=>'last_name']);
		$this->addColumn('email',['title'=>'email']);
		$this->addColumn('mobile',['title'=>'mobile']);
		$this->addColumn('gender',['title'=>'gender']);
		$this->addColumn('status',['title'=>'status']);

		return parent::_prepareColumns();
	}

	public function _prepareButtons()
	{
		$this->addButton('add',['title'=>'ADD']);
		$this->addButton('delete',['title'=>'DELETE']);

		return parent::_prepareButtons();
	}

}

?>