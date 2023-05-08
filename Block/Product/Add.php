<?php 

class Block_Product_Add extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/add.phtml');
		$this->getProducts();
	}

	public function getProducts()
	{
		$products = Ccc::getModel('product_row');
		return $products;
	}
}

?>