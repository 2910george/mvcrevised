<?php 

class Controller_Vendor extends Controller_Core_Action
{
	
	public function gridAction()
	{
		
		$layout = $this->getLayout();
		$grid = new Block_Vendor_Grid();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Vendor_Add();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		
			$layout = $this->getLayout();
			$edit = new Block_Vendor_Edit();
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

				$vendor_data = $request->getPost('vendor');
				if (!$vendor_data) {
					throw new Exception("Data Not found.", 1);
				}

				$vendorRow = Ccc::getModel('Vendor_Row');
				if (!$vendorRow) {
					throw new Exception("Error Processing Request", 1);
				}

				if ($id = (int)$request->getParam('vendor_id')) {
						$vendorRow->load($id);
						$vendorRow->updated_at = date('Y-m-d H:i:s');
				} else {
						$vendorRow->inserted_at = date('Y-m-d H:i:s');
				}

				$vendorRow->setData($vendor_data);
				if (!$vendorRow->save()) {
					throw new Exception("Data not Saved.", 1);
				}

				$address_data = $request->getPost('Address');
				if (!$address_data) {
					throw new Exception("Address Data Not found.", 1);
				}

				$addressRow = Ccc::getModel('Vendor_Address_Row');
				if (!$addressRow) {
					throw new Exception("Error Processing Request", 1);
				}

				$address_data['vendor_id'] = $vendorRow->vendor_id;
				if ($id = (int)$request->getParam('vendor_id')) {
						$addressRow->load($id,'vendor_id');
				}
				$addressRow->setData($address_data);

				if (!$addressRow->save()) {
					throw new Exception("Data not Saved.", 1);
				}
				$message->addMessage('VENDOR ADDED',Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('VENDOR ADDED',Model_Core_Message::FAILURE);
		}	
		header("Location: http://localhost/mvc/index.php?c=vendor&a=grid&p=1");
			
	}

	public function deleteAction()
	{
		try
		{
			$request = Ccc::getModel('Core_Request');
			$message = Ccc::getModel('Core_Message');
			if($request->isRequest())
			{
				$vendor_id = $request->getParam('vendor_id');
				$vendor = Ccc::getModel('Vendor_Row');
				$vendor->load($vendor_id);
				$vendor->delete();
			}
			$message->addMessage('VENDOR DELETED',Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('VENDOR NOT DELETED',Model_Core_Message::FAILURE);
		}
			header("Location: http://localhost/mvc/index.php?c=vendor&a=grid&p=1"); 
	}
}



?>