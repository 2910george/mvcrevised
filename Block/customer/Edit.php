<?php 

class Block_Customer_Edit extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/edit.phtml');
		$this->getCustomers();
	}

	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('customer_id');
		if($id)
		{
			$customer_row = Ccc::getModel('customer_row');
			$customers = $customer_row->load($id);
			$this->setData(['customers'=>$customers]);
			return $this;
		}
	}
}
?>