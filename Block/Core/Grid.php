<?php 

class Block_Core_Grid extends Block_Core_Template
{
	
	protected $_title = null;
	protected $_columns = [];
	protected $_actions = [];
	protected $_buttons = [];

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setColumns()
	{
		$this->$_columns =$_columns; 
	}

	public function getColumns()
	{
		return $this->$_columns;
	}

	public function addColumn($key,$value)
	{
		$this->$_columns[$key] = $value;
		return $this;
	}

	public function removeColumn($key)
	{
		unset($this->$_columns[$key]);
		return $this;
	}

	public function setActions(array $actions)
	{
		$this->$_actions = $actions;
	}

	public function getActions()
	{
		return $this->$_actions;
	}

	public function addAction($key,$value)
	{
		$this->$_actions[$key] = $value;
	}

	public function getAction($key)
	{
		return $this->$_actions[$key];
	}

	public function setButtons(array $buttons)
	{
		$this->$_buttons = $buttons
	} 

	public function getButtons()
	{
		return $this->buttons;
	}

	public function _prepareColumns()
	{
		return $this;
	}

	public function _prepareButtons()
	{
		return $this;
	}

	public function _prepareActions()
	{
		return $this;
	}

}

?>