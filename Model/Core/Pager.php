<?php 

class Model_Core_Pager 
{
	public $totalRecords = 0;
	public $currentPage = 0;
	public $numberOfPages = 0;
	public $start = 0;
	public $previous =0;
	public $recordPerPage = 5;
	public $next = 0;
	public $end = 0;
	public $recordPerPageOption = [5,10,50,100];
	public $startLimit = [5,10,15,20,25];


	function __construct()
	{
		$this->setCurrentPage();
	}

	public function setCurrentPage()
	{
		$this->currentPage = (int)Ccc::getModel('Core_Request')->getParam('p');
	}

	public function getCurrentPage()
	{
		return $this->currentPage;
	}

	public function setTotalRecords($totalRecords)
	{
		$this->totalRecords = $totalRecords;
		return $this;
	}

	public function getTotalRecords()
	{
		return $this->totalRecords;
	}

	public function getRecordPerPage()
	{
		return $this->recordPerPage;
	}

	public function setNumberOfPage($numberOfPages)
	{
		$this->numberOfPages = $numberOfPages;
		return $this; 
	}

	public function getNumberOfPages()
	{
		return $this->numberOfPages;
	}

	public function calculate()
	{
		$this->numberOfPages = ceil(($this->getTotalRecords())/($this->getRecordPerPage()));

		if($this->numberOfPages == 0)
		{
			$this->currentPage = 0;
		}

		if($this->currentPage > $this->numberOfPages)
		{
			$this->currentPage = $this->numberOfPages;
		}
		$this->start = 1;

		if(!$this->numberOfPages)
		{
			$this->start = 0;
		}

		if(!$this->currentPage==1)
		{
			$this->start = 0;
		}
		$this->end = $this->numberOfPages;

		if($this->currentPage == $this->numberOfPages)
		{
			$this->end = 0; 
		}

		$this->previous = ($this->getCurrentPage())-1;

		if(($this->getCurrentPage()) <= 1)
		{
			$this->previous = 0; 
		}

		$this->next = ($this->getNumberOfPages())+1;

		if($this->currentPage >= $this->numberOfPages )
		{
			$this->next = 0;
		}

		$this->startLimit = (($this->getCurrentPage()-1)*($this->recordPerPage));




	}
}


?>