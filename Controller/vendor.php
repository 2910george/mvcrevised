<?php 

class Controller_Vendor extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try
		{
			$query = "SELECT * FROM `vendor` JOIN `vendor_address` 
					ON vendor.vendor_id=vendor_address.vendor_id";
			$vendor = Ccc::getModel('Vendor_Row');
			$vendors = $vendor->fetchAll($query);
			$view = $this->getView();
			$view->setTemplate('vendor/grid.phtml');
			$view->setData(['vendors'=>$vendors]);
			$view->render();
		}
		catch(Exeception $e)
		{
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function addAction()
	{
		require_once 'view/vendor/add.phtml';
	}

	public function editAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isPost())
		{
			$vendor_id = $request->getParam('vendor_id');
			$vendor = Ccc::getModel('Vendor_Row');
			$data = $vendor->load($vendor_id);
			$address = Ccc::getModel('Vendor_Address_Row');
			$data2 = $address->load(15);
			$view = $this->getView();
			$view->setTemplate('vendor/edit.phtml');
			$view->setData(['vendors'=>$data]);
			$view->setData(['address'=>$data2]);
			$view->render(); 
		}
	}

	public function saveAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isPost())
		{
			$vendor_data = $request->getPost('vendor');
			$address_data = $request->getPost('Address');
			
			if(array_key_exists('vendor_id',$vendor_data))
			{
				$vendor_data['updated_at'] = date('Y-m-d H:i:s');

			}
			else
			{
				$vendor_data['inserted_at'] = date('Y-m-d H:i:s');
			}
			$vendor = Ccc::getModel('Vendor_Row');
			$address = Ccc::getModel('Vendor_Address_Row');

			$vendor->setData($vendor_data);
			$id = $vendor->save();
			//$address_data['vendor_id'] = $id;
			$address->setData($address_data);
			$id = $address->save();
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");

		}

	}

	public function deleteAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isRequest())
		{
			$vendor_id = $request->getParam('vendor_id');
			$vendor = Ccc::getModel('Vendor_Row');
			$vendor->load($vendor_id);
			$vendor->delete();
			header("Location: http://localhost/mvc/index.php?c=product&a=grid "); 
		}
	}
}



?>