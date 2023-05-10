<?php 

class Block_Vender_Grid extends Block_Core_Layout
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
	}

	public function prepareData()
	{
		$sql = "SELECT * FROM `vender`";
		$vender = Ccc::getModel('vender_row');
		$venders = $vender->fetchAll($vender);
		$vender->setData(['vendors'=>$vendors]);
		return $this;
	}
}

?>