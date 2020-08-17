<?php


namespace fantomx1\datatables\components\definitionsAssembler;


class Filter
{

    public $column;

    public $type;

    public function __construct(Column $column)
    {
        $this->column = $column;

    }


    public function setTypeSelect()
    {

        $this->type='select';
        return $this;
    }


    public function setTypeText()
    {

        $this->type='text';

        return $this;
    }


    public function getFilter():Column
    {

        return $this->column;

    }


    // @TODO: perhaps setData return it
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}
