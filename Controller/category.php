<?php 

class Controller_Category extends Controller_Core_Action
{
	
	public function gridAction()
	{
		
		$layout = $this->getLayout();
		$grid = new Block_Category_Grid();
		$layout->prepareChildren();
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}

	public function addAction()
	{
			$layout = $this->getLayout();
			$add = new Block_Category_Add();
			$layout->prepareChildren();
			$layout->getChild('content')->addChild('add  ',$add);
			$layout->render();
	}

	public function editAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isRequest())
		{

			$layout = $this->getLayout();
			$edit = new Block_Category_Edit();
			$layout->prepareChildren();
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		}
	}

	public function deleteAction()
	{
		try
		{
			$message = Ccc::getModel('Core_Message');
			$request = Ccc::getModel('Core_Request');
			if($request->isRequest())
			{
				$id = $request->getParam('category_id');
				$category = Ccc::getModel('Category_Row');
				$category->load($id);
				$category->delete();
			}
			$message->addMessage('CATEGORY DELETED',Model_Core_Message::SUCCESS);
		}
		catch(Exeception $e)
		{
			$message->getMessage()->addMessage('CATEGORY NOT DELETED',Model_Core_Message::FAILURE);
		}
			header("Location: http://localhost/mvc/index.php?c=category&a=grid&p=1");
	}
}


?>