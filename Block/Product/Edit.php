<?php 

class Block_Product_Edit extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/edit.phtml');
		$this->getProducts();
	}

	public function getProducts()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('product_id');
		if($id)
		{
			$product_row = Ccc::getModel('product_row');
			$products = $product_row->load($id);
			$this->setData(['products'=>$products]);
			return $this;
		}
	}
}
?>