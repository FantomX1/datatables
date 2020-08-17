<?php


namespace fantomx1\datatables\components;




use fantomx1\datatables\widgets\PaginatorWidget;

/**
 * Class QueryBuilder
 * @package fantomx1\datatables\components
 */
class QueryBuilder
{


    /**
     * @var ConfigObject
     */
    private $config;


    public function __construct(ConfigObject $config)
    {
        $this->config = $config;
    }

    /**
     * @param $query
     * @return string
     */
    public function buildCountQuery($query)
    {
        // @TODO: Select, sELECT
        return 'select SQL_CALC_FOUND_ROWS '
               .ltrim(trim(str_replace('SELECT', 'select', $query)), 'select');
    }


    /**
     * @param $sessionSort
     * @return string
     */
    public function filterClause($filter)
    {
        $where = "";

        $conf = $this->config->getConfig();
        $idsName = $conf['filterField']['ids'];


        // @TODO: check if all values were passed under the ids name , if somebody crashed the form?
        // @TODO: a form is not user submitted, but can be tampered by the user, at worst he would get undefined notice- follows lower
        // or check on a single common place defensive programming, not to check at 10 places, its not erased db item
        // better throw index than suppress it

        $i = 0;
        foreach ($filter[$idsName] as $columnName => $columnValues) {

            if (!$columnValues) {
                continue;
            }

            $i++;
            $values = explode(",", $columnValues);
            $values = array_map('intval', $values);
            $values = implode(",", $values);
            // secure right=values side against injection via intval

            if ($i>1) {
                $where .= " AND ";
            }

            // $column = mysqli_real_escape_string($c) , needs a connection link identifier
            $columnName = addslashes($columnName);
            $where .= " `$columnName` IN (".$values.")";

        }

        //
        // @TODO: still not very secure, remake to PDO
        // @TODO: improve sql injections by values being in specified columns, or in columns returned, more transparent maybe than binded params
        //

        return $where ? ' WHERE '.$where:'';

        //return " ORDER BY " . $sessionSort['column'] . ' ' . $sessionSort['dir'];

    }

    /**
     * @param $sessionSort
     * @return string
     */
    public function orderByClause($sessionSort)
    {
        return " ORDER BY " . $sessionSort['column'] . ' ' . $sessionSort['dir'];

    }


    /**
     * @param PaginatorWidget $paginator
     * @param $query
     * @return string
     */
    public function addLimitClause(
        PaginatorWidget $paginator,
       $query
    )
    {

        $onPage = $paginator->getOnPage();

        $page        = $paginator->getPage();
        return $query .= " LIMIT " . ($page - 1) * $onPage . "," . $onPage;
    }

}
