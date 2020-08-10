<?php


namespace fantomx1\datatables;


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
        $sessionSort = &$_SESSION[static::$name. "_sortBy"] ?? [];

        if (isset($_GET['sortBy'])
            && // if request for sorting and there is no definition or the requested column is allowed to be sorted
            (empty(static::$columnsDefinition)
             || !empty(static::$columnsDefinition[$_GET['sortBy']]['orderable'])
            )
        ) {

            //if (isset($sessionSort['column']) &&
            if (!empty($sessionSort['column'])
                && $sessionSort['column'] == $_GET['sortBy']
                && $sessionSort['dir'] == "ASC"
            ) {
                $sessionSort['dir'] = "DESC";

            } else {

                // sometimes must be else, before it would affect the order as if prior set originated from the
                // previous session, whereas it's also a default overwriting always
                $sessionSort['column'] = $_GET['sortBy'];
                $sessionSort['dir']    = "ASC";

            }
        }

        return $sessionSort;
    }

}
