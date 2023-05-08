<?php 

class Block_Vendor_Add extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/add.phtml');
		$this->getVendors();
	}

	public function getVendors()
	{
		$vendors = Ccc::getModel('Vendor_row');
		return $vendors;
	}
}

?>