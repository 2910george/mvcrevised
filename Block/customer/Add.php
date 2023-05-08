<?php 

class Block_customer_Add extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/add.phtml');
		$this->getCustomers();
	}

	public function getCustomers()
	{
		$customers = Ccc::getModel('customer_row');
		return $customers;
	}
}

?>