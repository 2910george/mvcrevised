<?php 

class Block_Customer_Grid  extends Block_Core_Layout
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/grid.phtml');
		$this->prepareData();
	}

	public function prepareData()
	{
		
		$pager = $this->getPager();
		$sql1 = "SELECT COUNT(`customer_id`) FROM `customer`";
		$total = Ccc::getModel('Core_Adapter')->fetchOne($sql1);
		$count = $total['COUNT(`customer_id`)'];

		$pager->setTotalRecords($count)->calculate();

		$sql2 = "SELECT * FROM `customer` JOIN `customer_address` ON customer.customer_id=customer_address.customer_id  LIMIT $pager->startLimit,$pager->recordPerPage";
		$customer_row = Ccc::getModel('customer_row');
		$customers = $customer_row->fetchAll($sql2);
		$this->setData(['customers'=>$customers]);
		return $this;


		/*$sql = "SELECT * FROM `customer` JOIN `customer_address` ON customer.customer_id=customer_address.customer_id";
		$customer_row = Ccc::getModel('Customer_Row');
		$customers = $customer_row->fetchAll($sql);
		$this->setData(['customers'=>$customers]);
		return $this;*/ 
	}


}


?>