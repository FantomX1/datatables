<?php


namespace fantomx1\datatables\components;


use fantomx1\iohandlers\handlers\GetHandler;
use fantomx1\iohandlers\handlers\SessionHandler;

/**
 * Class SignalHandlers
 * @package fantomx1\datatables
 */
class SignalHandlers
{

    /**
     * @var
     */
    public  $name;
    /**
     * @var
     */
    public  $columnsDefinition;


    public $config;


    public function __construct(ConfigObject $config)
    {
        $this->config = $config;
    }



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnsDefinition()
    {
        return $this->columnsDefinition;

    }

    /**
     * @param mixed $columnsDefinition
     */
    public  function setColumnsDefinition($columnsDefinition)
    {
        $this->columnsDefinition = $columnsDefinition;
        return $this;
    }


    public function filterSignalEventListener()
    {

        $config = $this->config->getConfig();

//        'filterField'=>
//                [
//                    'name'=>'f',
//                    'ids'=>'i',
//                    'values'=>'v',
//                ]


        $filter = SessionHandler::get($this->name. "_filter",[]);

        $filterVar = $config['filterField']['name'];
//        $filterIds = $config['filterField']['ids'];
//        $filterValues = $config['filterField']['values'];

        //$filterVar = $filterName.'['.$filterName.']';

        if (
            GetHandler::get($filterVar)
        ) {

            $filter  = GetHandler::get($filterVar);
            SessionHandler::set($this->name. "_filter", $filter);
        }

        return $filter;

    }


    /**
     * @param array $sessionSort
     * @return array|mixed
     */
    public  function sortSignalEventListener()
    {
        // @TODO: get from some common session storage class handler
        //$sessionSort = &$_SESSION[::$name. "_sortBy"] ?? [];

        $sessionSort = SessionHandler::get($this->name. "_sortBy",[]);

//        RequestHandler::get('sdasda');


        $getSortBy = GetHandler::get('sortBy');
        if (GetHandler::get('sortBy')
            && // if request for sorting and there is no definition or the requested column is allowed to be sorted
            (empty($this->columnsDefinition)
             || !empty($this->columnsDefinition[$getSortBy]->orderable)
                // @TODO: dont' order all/implicitly when empty
            )
        ) {

            //if (isset($sessionSort['column']) &&
            if (!empty($sessionSort['column'])
                && $sessionSort['column'] == $getSortBy
                && $sessionSort['dir'] == "ASC"
            ) {
                $sessionSort['dir'] = "DESC";

            } else {

                // sometimes must be else, before it would affect the order as if prior set originated from the
                // previous session, whereas it's also a default overwriting always
                $sessionSort['column'] = $getSortBy;
                $sessionSort['dir']    = "ASC";

            }

            SessionHandler::set($this->name. "_sortBy", $sessionSort);
        }



        return $sessionSort;
    }

}
