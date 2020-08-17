<?php


namespace fantomx1\datatables\components\definitionsAssembler;


class Column
{

    /*
     * @var Filter @filter
     */
    public $filter;

    public $caption;

    public $orderable;

    public $name;

    public function __construct()
    {





    }

    public function getName()
    {
        return $this->name;

    }

    public function setName($name)
    {

        $this->name = $name;

    }


    public function setFilter()
    {
        $this->filter = new Filter($this);

        return $this->filter;

    }


    public function getFilter()
    {

        return $this->filter;

    }




    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    public function setOrderable()
    {
        $this->orderable = true;
        return $this;
    }
}
