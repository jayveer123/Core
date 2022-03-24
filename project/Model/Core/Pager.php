<?php
class Model_Core_Pager{

    public $perPageCountOption = [ 20, 30, 40, 60, 100 ];

    protected $PerPageCount = 20;
    protected $TotalCount = 0;
    protected $PageCount = 20;
    protected $start = 1;
    protected $end = 20;
    protected $prev = 20;
    protected $next= 20;
    protected $current = 20;
    protected $StartLimit = 20;
    protected $EndLimit=20;

    public function getPerPageCountOption()
    {
        return $this->perPageCountOption;
    }

    public function setPerPageCountOption($perPageCountOption)
    {
        $this->perPageCountOption = $perPageCountOption;
    }

    public function setPerPageCount($PerPageCount)
    {
        $this->PerPageCount = $PerPageCount;
    }
    public function getPerPageCount()
    {
        return $this->PerPageCount;
    }

    public function setTotalCount($TotalCount)
    {
        $this->TotalCount = $TotalCount;
    }
    public function getTotalCount()
    {
        return $this->TotalCount;
    }

    public function setPageCount($PageCount)
    {
        $this->PageCount = $PageCount;
    }
    public function getPageCount()
    {
        return $this->PageCount;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }
    public function getStart()
    {
        return $this->start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }
    public function getEnd()
    {
        return $this->end;
    }

    public function setPrev($prev)
    {
        $this->prev = $prev;
    }
    public function getPrev()
    {
        return $this->prev;
    }

    public function setNext($next)
    {
        $this->next = $next;
    }
    public function getNext()
    {
        return $this->next;
    }

    public function setCurrent($current)
    {
        $this->current = $current;
    }
    public function getCurrent()
    {
        return $this->current;
    }

    public function setStartLimit($StartLimit)
    {
        $this->StartLimit = $StartLimit;
    }
    public function getStartLimit()
    {
        return $this->StartLimit;
    }

    public function setEndLimit($EndLimit)
    {
        $this->EndLimit = $EndLimit;
    }
    public function getEndLimit()
    {
        return $this->EndLimit;
    }


    public function execute($totalCount , $current, $perPageCountOption){

        $this->setPerPageCount($perPageCountOption);

        $this->setStartLimit($perPageCountOption);
        $this->setEndLimit(($totalCount == 0)?1:$perPageCountOption);

        $this->setTotalCount($totalCount);
        $this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));

        $this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($current < $this->getStart()) ? $this->getStart() : $this->getCurrent());

        $this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setEnd(($this->getCurrent() == $this->getPageCount()) ? null : $this->getPageCount());

        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));
        $this->setStartLimit( ($totalCount == 0) ? 1 : ($this->getPerPageCount() * ($this->getCurrent() - 1)));

        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent() - 1);
        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);
        
    }
    function getAdapter()
    {
        global $adapter;
        return $adapter;
    }


}

?>