<?php


namespace fantomx1\datatables\components\definitionsAssembler;


use fantomx1\datatables\widgets\DataTableWidget;

/**
 * Class Filter
 * @package fantomx1\datatables\components\definitionsAssembler
 */
class Filter
{

    /**
     * @var Column
     */
    public $column;

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    private $data;

    /**
     * Filter constructor.
     * @param Column $column
     */
    public function __construct(Column $column)
    {
        $this->column = $column;

    }


    /**
     * @return mixed
     */
    public function getData()
    {

        return $this->data;
    }


    /**
     * @return $this
     */
    public function setTypeSelect()
    {

        $this->type='select';
        return $this;
    }


    /**
     * @return $this
     */
    public function setTypeText()
    {

        $this->type='text';

        return $this;
    }


    /**
     * @return Column
     */
    public function getFilter():Column
    {

        return $this->column;

    }

    /**
     * @param $table
     * @param $id
     * @param $name
     * @return $this
     */
    public function setDataQuery($table, $id, $name)
    {

        $queryExecutor = DataTableWidget::$assoc_queryExecutor;

        $rows = $queryExecutor->execute("Select ".$id.",".$name." from ".$table);


        $result= [];
        foreach ($rows as $row) {

            $result[$row[$id]] = $row[$name];
        }

        $this->setData($result);
        return $this;

    }



    // @TODO: perhaps setData return it

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

}
