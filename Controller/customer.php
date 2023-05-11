<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Model/Core/View.php';

class Controller_Customer extends Controller_Core_Action
{
	
	public function gridAction()
	{
		
		$layout = $this->getLayout();
		$grid = new Block_Customer_Grid();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Customer_Add();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
		    
	}

	public function editAction()
	{
			$layout = $this->getLayout();
			$edit = new Block_Customer_Edit();
			$layout->prepareChildren();
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();

	}
	public function saveAction()
	{
		try 
		{
				
			$request = Ccc::getModel('Core_Request');
			$message = Ccc::getModel('Core_Message');
			if(!$request->isPost()){
				throw new Exception("Error Processing Request", 1);
			}

				$customer_data = $request->getPost('customer');
				if (!$customer_data) {
					throw new Exception("Data Not found.", 1);
				}

				$customerRow = Ccc::getModel('Customer_Row');
				if (!$customerRow) {
					throw new Exception("Error Processing Request", 1);
				}

				if ($id = (int)$request->getParam('customer_id')) {
						$customerRow->load($id);
						$customerRow->updated_at = date('Y-m-d H:i:s');
				} else {
						$customerRow->inserted_at = date('Y-m-d H:i:s');
				}

				$customerRow->setData($customer_data);
				if (!$customerRow->save()) {
					throw new Exception("Data not Saved.", 1);
				}

				$address_data = $request->getPost('Address');
				if (!$address_data) {
					throw new Exception("Address Data Not found.", 1);
				}

				$addressRow = Ccc::getModel('Customer_Address_Row');
				if (!$addressRow) {
					throw new Exception("Error Processing Request", 1);
				}

				$address_data['customer_id'] = $customerRow->customer_id;
				if ($id = (int)$request->getParam('customer_id')) {
						$addressRow->load($id,'customer_id');
				}
				$addressRow->setData($address_data);

				if (!$addressRow->save()) {
					throw new Exception("Data not Saved.", 1);
				}
				$message->addMessage('CUSTOMER ADDED',Model_Core_Message::SUCCESS);
			}
			catch(Exeception $e)
			{
				$message->getMessage()->addMessage('CUSTOMER NOT ADDED',Model_Core_Message::FAILURE);
			}
			header("Location: http://localhost/mvc/index.php?c=customer&a=grid&p=1");
	}

	public function deleteAction()
	{
		try
		{	
			$request = Ccc::getModel('Core_Request');
			$message = Ccc::getModel('Core_Message');
			if($request->isRequest())
			{
				$customer_id = $request->getParam('customer_id');
				$customer = Ccc::getModel('Customer_Row');
				$customer->load($customer_id);
				$customer->delete();

			}
			$message->getMessage('CUSTOMER DELETED',Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('CUSTOMER NOT DELETED',Model_Core_Message::FAILURE);
			
		}
			header("Location: http://localhost/mvc/index.php?c=customer&a=grid ");
	}
}


?>