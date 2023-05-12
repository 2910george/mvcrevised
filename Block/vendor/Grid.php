<?php 

class Block_Vendor_Grid extends Block_Core_Layout
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
		$this->prepareData();
	}

	public function getCollection()
	{
		
		$pager = $this->getPager();
		$sql1 = "SELECT COUNT(`vendor_id`) FROM `vendor`";
		$total = Ccc::getModel('Core_Adapter')->fetchOne($sql1);
		$count = $total['COUNT(`vendor_id`)'];

		$pager->setTotalRecords($count)->calculate();

		$sql2 = "SELECT * FROM `vendor` JOIN `vendor_address` ON vendor.vendor_id = vendor_address.vendor_id LIMIT $pager->startLimit,$pager->recordPerPage ";
		$vendor_row = Ccc::getModel('vendor_row');
		$vendors = $vendor_row->fetchAll($sql2);
		$this->setData(['vendors'=>$vendors]);
		return $this;
	}

	public function count()
	{
		$sql = "SELECT COUNT('vendor_id') FROM `vendor`";
		$count = Ccc::getModel('Vendor_row')->fetchOne($sql);
		return $count;
	}

	public function _prepareAction()
	{
		$this->addAction('edit',['title' => 'EDIT']);
		$this->addAction('delete',['title' => 'DELETE']);

		return parent::_prepareAction();
	}

	public function _prepareColumns()
	{
		  $this->addColumn('vendor_id',['title'=>'vendor_id']);
		  $this->addColumn('first_name',['title'=>'first_name']);
		  $this->addColumn('last_name',['title'=>'last_name']);
		  $this->addColumn('email',['title'=>'mobile']);
		  $this->addColumn('mobile',['title'=>'mobile']);
		  $this->addColumn('gender',['title'=>'gender']);
		  $this->addColumn('status',['title'=>'status']);

		  return parent::_prepareColumns();
	}

	public function _prepareButtons()
	{
		$this->addButton('CANCEL',['title'=>'CANCEL']);
		$this->addButton('ADD',['title'=>'ADD']);

		return parent::_prepareButtons();
	}


}

?>