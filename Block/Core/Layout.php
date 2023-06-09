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

		$message = new Block_Html_Message();
		$this->addChild('message',$message);
	}

	public function createBlock($Block)
	{
		$blockname = 'Block_'.$block;
		$block = new $blockname();
		$block->setLayout($this);
		return $block;
	}
	public function setPager($pager)
    {
    	$this->pager = $pager;
    }

    public function getPager()
    {
    	if($this->pager)
    	{
    		return $this->pager;
    	}
    	$pager = Ccc::getModel('Core_Pager');
    	$rpp = Ccc::getModel('Core_Request')->getParam('p');
    	$this->setPager($pager);
    	return $this->pager;
    }
}


?>