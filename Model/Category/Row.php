<?php 
echo "111";
class Model_Category_Row extends Model_Core_Table_Row
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Category');
	}
}



?>