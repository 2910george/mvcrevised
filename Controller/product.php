<?php 

require_once 'Controller/Core/Action.php';
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/View.php';

class Controller_Product extends Controller_Core_Action
{
	
	public function gridAction()
	{
	
		$layout = $this->getLayout();
		$grid = new Block_Product_Grid();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
		
	}

	public function saveAction()
	{
		try
		{
			$request = new Model_Core_Request();
			$message = Ccc::getModel('Core_Message');
			if($request->isPost())
			{
				$data = $request->getPost();
	            $id = $request->getParam('product_id');
	            if($id)
	            {
	            	$products = Ccc::getModel('Product_Row');
	            	$products->load($id);
	            	$data['updated_at']=date('Y-m-d H:i:s');
	            }
	            else
	            {
					$products = Ccc::getModel('Product_Row');
					$data['inserted_at'] = date("Y-m-d H:i:s");
			    }
				$products->setData($data);
				$products->save();
				header("Location: http://localhost/mvc/index.php?c=product&a=grid&p=1");
			}
			$zipcode =$data['zipcode'];
			$message->addMessage($zipcode,Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('PRODUCT NOT ADDED',Model_Core_Message::FAILURE);
		}
	}

	public function editAction()
	{
		$request = new Model_Core_Request();
		if($request->isRequest())
		{
			
			$layout = $this->getLayout();
			$edit = new Block_Product_Edit();
			$layout->prepareChildren();
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
			
		}
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Product_Add();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}	

	public function deleteAction()
	{
		try
		{
			$message = Ccc::getModel('Core_Message'); 
			// print_r($message);die();
			$request = new Model_Core_Request();
			if($request->isRequest())
			{

				$product_id = $request->getParam('product_id');
				$product = Ccc::getModel('Product_Row');
				$product->load($product_id);
				$result = $product->delete();
			}
			$message->addMessage('PRODUCT DELETED',Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('PRODUCT NOT DELETED',Model_Core_Message::FAILURE);
		}
			header("Location: http://localhost/mvc/index.php?c=product&a=grid&p=1");

	}
}

?>