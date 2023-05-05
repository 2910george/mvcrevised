<?php 

class Controller_Category extends Controller_Core_Action
{
	
	public function gridAction()
	{
		$query = "SELECT * FROM `category`";
		$category = Ccc::getModel('Category_Row');
		$categorys = $category->fetchAll($query);

		$view = $this->getView();
		$view->setTemplate('category/grid.phtml');
		$view->setData(['categorys'=>$categorys]);
		$view->render();
	}

	public function editAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isRequest())
		{
		  $id = $request->getParam('category_id'); 
		  $category = Ccc::getModel('Category_Row');
		  $data = $category->load($id);
		  $view = $this->getView();
		  $view->setTemplate('category/edit.phtml');
		  $view->setData(['categorys'=>$data]);
		  $view->render();
		}
	}

	public function deleteAction()
	{
		$request = Ccc::getModel('Core_Request');
		if($request->isRequest())
		{
			$id = $request->getParam('category_id');
			$category = Ccc::getModel('Category_Row');
			$category->load($id);
			$category->delete();
			header("Location: http://localhost/mvc/index.php?c=product&a=grid ");

		}
	}
}


?>