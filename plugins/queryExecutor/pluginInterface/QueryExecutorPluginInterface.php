<?php


namespace fantomx1\datatables\plugins\queryExecutor\pluginInterface;


/**
 * Interface QueryExecutorPluginInterface
 * @package fantomx1\datatables\plugins\queryExecutor\pluginInterface
 */
interface QueryExecutorPluginInterface
{


    /**
     * @param $query
     * @return array
     */
    public function execute($query):array;



}
