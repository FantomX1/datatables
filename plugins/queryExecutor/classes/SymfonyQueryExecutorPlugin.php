<?php


namespace fantomx1\datatables\plugins\queryExecutor\classes;


use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;
use fantomx1\datatables\widgets\DataTableWidget;
use  Doctrine\DBAL\Connection;

/**
 *
 * For Symfony, register this class as a Symfony service
 *
 * Class SymfonyQueryExecutorPlugin
 * @package fantomx1\datatables\plugins\queryExecutor\classes
 */
class SymfonyQueryExecutorPlugin implements QueryExecutorPluginInterface
{


    /**
     * @var Connection
     */
    public $connection;


    /**
     * SymfonyQueryExecutorPlugin constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {

        $this->connection = $connection;

        DataTableWidget::$assoc_queryExecutor = $this;
    }
    
    
    /**
     * @param $query
     * @return array
     */
    public function execute($query): array
    {

        //return $this->connection->exec($query)->fetchAll();
        return $this->connection->fetchAll($query);
        // sometimes the syntax select->from is converted to string
//        return $query->execute()
//            ->fetchAll();

        // @TODO:
    }
}

