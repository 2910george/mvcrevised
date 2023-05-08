<?php 

class Block_Category_Edit extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/edit.phtml');
		$this->getCustomers();
	}

	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
		$id = $request->getParam('category_id');
		if($id)
		{
			$category_row = Ccc::getModel('category_row');
			$categorys = $category_row->load($id);
			$this->setData(['categorys'=>$categorys]);
			return $this;
		}
	}
}
?>