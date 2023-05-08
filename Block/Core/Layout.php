<?php 

class Block_Core_Layout extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/layout/3columns.phtml');
	}

	public function prepareChildren()
	{
		$content = new Block_Html_Content();
		$this->addChild('content',$content);

		$left = new Block_Html_Left();
		$this->addChild('left',$left);

		$right = new Block_Html_Right();
		$this->addChild('right',$right);
	}

	public function createBlock($Block)
	{
		$blockname = 'Block_'.$block;
		$block = new $blockname();
		$block->setLayout($this);
		return $block;
	}
}


?>