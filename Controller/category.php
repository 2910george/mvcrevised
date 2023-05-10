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

		/*$query = "SELECT * FROM `category`";
		$category = Ccc::getModel('Category_Row');
		$categorys = $category->fetchAll($query);

		$view = $this->getView();
		$view->setTemplate('category/grid.phtml');
		$view->setData(['categorys'=>$categorys]);
		$view->render();*/
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

		 /* $id = $request->getParam('category_id'); 
		  $category = Ccc::getModel('Category_Row');
		  $data = $category->load($id);
		  $view = $this->getView();
		  $view->setTemplate('category/edit.phtml');
		  $view->setData(['categorys'=>$data]);
		  $view->render();*/
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