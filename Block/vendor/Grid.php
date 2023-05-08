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
		$sql = "SELECT * FROM `vendor`";
		$vender = Ccc::getModel('vendor_row');
		$vendors = $vender->fetchAll($sql);
		$this->setData(['vendors'=>$vendors]);
		return $this;
	}
}

?>