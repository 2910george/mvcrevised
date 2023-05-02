<?php 

class Controller_Core_Action
{
	public $message = null;
	public $layout = null;
	public $request = null;

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