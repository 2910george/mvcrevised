<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/View.php';

class Controller_Customer extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try
		{
			$query = "SELECT * FROM `customer`";
			/*$query = "SELECT * FROM `customer` JOIN `customer_address` 
		          ON customer.customer_id=customer_address.customer_id ";*/
			$customer = Ccc::getModel('Customer_Row');
			$customers = $customer->fetchAll($query);
			if(!$customers)
			{
				throw new Exception("Error Processing Request", 1);
			}
			$view = $this->getView();
			$view->setTemplate('customer/grid.phtml');
			$view->setData(['customers'=>$customers]);
			$view->render();
		}
		catch(Exeception $e)
		{
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function addAction()
	{
		    $view = $this->getView();
			$view->setTemplate('customer/add.phtml');
			$view->render();
	}
	public function saveAction()
	{
		try
		{
				$request = Ccc::getModel('Core_Request');
			if($request->isPost())
			{
				$customer_data = $request->getPost('customer');
				$address_data = $request->getPost('Address');
			
				if(array_key_exists('customer_id',$customer_data))
				{
					$customer_data['updated_at'] = date('Y-m-d H:i:s');
				}
				else
				{
					$customer_data['inserted_at'] = date('Y-m-d H:i:s');
				}

				$customer = Ccc::getModel('Customer_Row');
				$address = Ccc::getModel('Customer_Address_Row');
				$customer->setData($customer_data);
				$id['customer_id'] = $customer->save($customer_data);
				array_push($address_data, $id);
				$address->setData($address_data);
				$address->save($address_data);
				header("Location: http://localhost/mvc/index.php?c=customer&a=grid ");

			}
		}
		catch(Exeception $e)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
	}

	public function deleteAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isRequest())
		{
			$customer_id = $request->getParam('customer_id');
			$customer = Ccc::getModel('Customer_Row');
			$customer->load($customer_id);
			$customer->delete();
			header("Location: http://localhost/mvc/index.php?c=customer&a=grid ");

		}
	}
}


?>