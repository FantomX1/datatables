<?php


namespace fantomx1\datatables\components;


use fantomx1\datatables\PaginatorWidget;

/**
 * Class QueryBuilder
 * @package fantomx1\datatables\components
 */
class QueryBuilder
{


    /**
     * @param $query
     * @return string
     */
    public function buildCountQuery($query)
    {
        return 'select SQL_CALC_FOUND_ROWS '
               .ltrim(trim(str_replace('SELECT', 'select', $query)), 'select');
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
    public function addLimitClause(PaginatorWidget $paginator,
                                   $query)
    {

        $onPage = $paginator->getOnPage();

        $page        = $paginator->getPage();
        return $query .= " LIMIT " . ($page - 1) * $onPage . "," . $onPage;
    }

}
