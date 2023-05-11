<?php 

class Block_Vendor_Grid extends Block_Core_Layout
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
		$this->prepareData();
	}

	public function prepareData()
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

		/*$sql = "SELECT * FROM `vendor`";
		$vender = Ccc::getModel('vendor_row');
		$vendors = $vender->fetchAll($sql);
		$this->setData(['vendors'=>$vendors]);
		return $this;*/
	}
}

?>