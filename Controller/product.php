<?php 

require_once 'Controller/Core/Action.php';
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/View.php';

class Controller_Product extends Controller_Core_Action
{
	
	public function gridAction()
	{
		
		try
		{
			$query = "SELECT * FROM `product`";
			$product = Ccc::getModel('Product_Row');
			$products = $product->fetchAll($query);
			if(!$products)
			{
				throw new Exception("Error Processing Request", 1);
			}
			$view = $this->getView();
			$view->setTemplate('product/grid.phtml');
			$view->setData(['products'=>$products]);
			$view->render();
		}
		catch(Exeception $e)
		{
			throw new Exception("Error Processing Request", 1);
			
		}

	}

	public function saveAction()
	{
		$request = new Model_Core_Request();
		if($request->isPost())
		{
			$data = $request->getPost();
			
            $id = $request->getParam('product_id');
            if($id)
            {
            	$products = Ccc::getModel('Product_Row');
            	$products->load($id);
            	$products->updated_at=date('Y-m-d H:i:s');
            }
            else
            {
				$products = Ccc::getModel('Product_Row');
				$products->inserted_at = date("Y-m-d H:i:s");
		    }
			$products->setData($data);
			$products->save();
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");
		}
	}

	public function editAction()
	{
		$request = new Model_Core_Request();
		if($request->isRequest())
		{
			$product_id = $request->getParam('product_id');
			$products = Ccc::getModel('Product_Row');
			$data = $products->load($product_id);
			print_r($data);
			$view = $this->getView();
			$view->setTemplate('product/edit.phtml');
			$view->setData(['products'=>$data]);
			$view->render();
			
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
			$product = Ccc::getModel('Product_Row');
			$product->load($product_id);
			$result = $product->delete();
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");
		}
	}
}

?>