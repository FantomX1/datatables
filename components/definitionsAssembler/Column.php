<?php


namespace fantomx1\datatables\components\definitionsAssembler;


use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;
use fantomx1\datatables\widgets\DataTableWidget;

/**
 * Class Column
 * @package fantomx1\datatables\components\definitionsAssembler
 */
class Column
{

    /*
     * @var Filter @filter
     */
    /**
     * @var
     */
    public $filter;

    /**
     * @var
     */
    public $caption;

    /**
     * @var
     */
    public $orderable;

    /**
     * @var
     */
    public $name;


    /**
     * @var
     */
    public $queryExecutor;

//    public $datatable;
//    public function __construct(DataTableWidget $datatable)


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;

    }

    /**
     * @param $name
     */
    public function setName($name)
    {

        $this->name = $name;

    }


    /**
     * @return Filter
     */
    public function setFilter()
    {
        $this->filter = new Filter($this);

        return $this->filter;

    }


    /**
     * @return mixed
     */
    public function getFilter()
    {

        return $this->filter;

    }


    /**
     * @param $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return $this
     */
    public function setOrderable()
    {
        $this->orderable = true;
        return $this;
    }
}
