<?php 

class Block_Vendor_Edit extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/edit.phtml');
		$this->getVendors();
	}

	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('vendor_id');
		if($id)
		{
			$vendor_row = Ccc::getModel('vendor_row');
			$address_row = Ccc::getModel('Vendor_Address_Row');
			$vendors = $vendor_row->load($id);
			$address = $vendor_row->load($id);
			$this->setData(['vendors'=>$vendors,'address'=>$address]);
			return $this;
		}
	}
}

?>