<?php Ccc::loadClass('Block_Core_Template');
class Block_Core_Grid extends Block_Core_Template  
{


    protected $actions = [];
    protected $collection = [];
    protected $columns = []; 
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('view/core/grid.php');
        $this->prepareCollections();
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this; 
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addColumn(array $column, $key)
    {
        if(!$key)
        {
            return null;
        }
        $this->columns[$key] = $column;
        return $this;
    }

    public function getColumn($key)
    {
        if(!array_key_exists($key,$this->columns))
        {
            return null;
        }
        return $this->columns[$key];
    }

    public function setColumn($column,$key)
    {
        $this->columns[$key] = $column;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }
    public function addAction(array $action,$key)
    {
        $this->actions[$key] = $action ;
        return $this;
    }
    public function getAction($key)
    {
        if(!array_key_exists($key,$this->actions))
        {
            return null;
        }
        return $this->actions[$key];
    }

    public function setAction(array $action,$key)
    {
        $this->actions[$key] = $action;
        return $this;
    }

    public function getColumnData($column, $collection)
    {
        $key = $column['key'];
        if($key == 'status')
        {
            return $collection->getStatus($collection->status);
        }
        if($key == 'stetus')
        {
            return $collection->getStatus($collection->stetus);
        }

        if($key == 'base')
        {
            if($collection->getBase())
            {
                $image = $collection->getBase()->getImgPath();
                return "<img src='{$image}' alt='' width='50' height='50'>";
            }
            return "Image Not Set.";
        }
        if($key == 'thumb')
        {
            if($collection->getThumb())
            {
                $image = $collection->getThumb()->getImgPath();
                return "<img src='{$image}' alt='' width='50' height='50'>";
            }
            return "Image Not Set.";
        }
        if($key == 'small')
        {
            if($collection->getSmall())
            {
                $image = $collection->getSmall()->getImgPath();
                return "<img src='{$image}' alt='' width='50' height='50'>";
            }
            return "Image Not Set.";
        }
        return $collection->$key;
    }

}