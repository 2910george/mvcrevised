<?php 
require_once 'Model/Core/View.php';
class Controller_Core_Action extends Model_Core_View
{
	public $message = null;
	public $layout = null;
	public $request = null;
	public $view = null;
    public $pager = null;

    
	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
	}

	public function getLayout()
	{
		if($this->layout)
		{
			return $this->layout;
		}
		$layout = new Block_Core_Layout();
		$this->setLayout($layout);
		return $this->layout;
	}
	public function setView($view)
	{
		$this->view = $view;
	}

	public function getView()
	{
		if($this->view)
		{
			return $this->view;
		}
		$view = new Model_Core_View();
		$this->setView($view);
		return $this->view;

	}

	public function setMessage(Model_Core_Message $message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if($this->message)
		{
			return $this->message;
		}
		$message = new Model_Core_Message();
		$this->setMessage($message);
		return $this->message;
	}

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if($this->request)
		{
			return $this->request;
		}
		$request =  new Model_Core_Request();
		$this->setRequest($request);
		return $this->request;
	}
}

?>