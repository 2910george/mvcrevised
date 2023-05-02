<?php 

require_once 'Controller/Core/Action.php';
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';

class Controller_Product extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$query = "SELECT * FROM `product`";
		$adpter = new Model_Core_Adapter();
		$products = $adpter->fetchAll($query);

		require_once 'view/product/grid.phtml';

	}

	public function addAction()
	{
		$request = new Model_Core_Request();
		if($request->isPost())
		{
			$data = $request->getPost();
			$name = $data['name'];
			$sku = $data['sku'];
			$price = $data['price'];
			$cost = $data['cost'];
			$quantity = $data['quantity'];
			$status = $data['status'];
			$discription = $data['discription'];
			$inserted_at = date('Y-m-d H:i:s');
		
			$query = "INSERT INTO `product`( `name`, `sku`, `cost`, `price`, `quantity`, `status`, `discription`, `inserted_at`) 
				VALUES ('$name','$sku','$cost','$price','$quantity','$status','$discription','$inserted_at')";

			$adpter = new Model_Core_Adapter();
			$adpter->insert($query);
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");
		}
	}

	public function editAction()
	{
		$request = new Model_Core_Request();
		if($request->isRequest())
		{
			$product_id = $request->getParam('product_id');
			echo $product_id;
			$adpter = new Model_Core_Adapter();
			$query = "SELECT * FROM `product` WHERE `product_id` = $product_id";
			$product = $adpter->fetchOne($query);
		    require_once 'view/product/edit.phtml';

		}
	}

	public function updateAction()

	{
		$request = new Model_Core_Request();

		if($request->isPost())
		{		
			$data = $request->getPost();
			$product_id = $data['product_id'];
			$name = $data['name'];
			$sku = $data['sku'];
			$price = $data['price'];
			$cost = $data['cost'];
			$quantity = $data['quantity'];
			$status = $data['status'];
			$discription = $data['discription'];
			$updated_at = date('Y-m-d H:i:s');

				$query = "UPDATE `product` 
						  SET `name`='$name',`sku`='$sku',`cost`='$cost',`price`='$price',`quantity`='$quantity',`status`='$status',`discription`='$discription',`updated_at`='$updated_at' 
						  WHERE `product_id` = $product_id";

			$adpter = new Model_Core_Adapter();
			$adpter->update($query);
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");

		}
	}

	public function deleteAction()
	{
		$request = new Model_Core_Request();
		if($request->isRequest())
		{

			$product_id = $request->getParam('product_id');

			$query = "DELETE FROM `product` WHERE `product_id` = $product_id";
			$adpter = new Model_Core_Adapter();
			$result = $adpter->delete($query);
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");
		}
	}
}

?>