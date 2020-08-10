<?php


namespace fantomx1\datatables;


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
    public static $name;
    /**
     * @var
     */
    public static $columnsDefinition;


    /**
     * @param array $sessionSort
     * @return array|mixed
     */
    public static function sortEventSignalListener()
    {
        // @TODO: get from some common session storage class handler
        //$sessionSort = &$_SESSION[static::$name. "_sortBy"] ?? [];

        $sessionSort = SessionHandler::get(static::$name. "_sortBy",[]);

//        RequestHandler::get('sdasda');


        $getSortBy = GetHandler::get('sortBy');
        if (GetHandler::get('sortBy')
            && // if request for sorting and there is no definition or the requested column is allowed to be sorted
            (empty(static::$columnsDefinition)
             || !empty(static::$columnsDefinition[$getSortBy]['orderable'])
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
        }

        SessionHandler::set(static::$name. "_sortBy", $sessionSort);

        return $sessionSort;
    }

}
