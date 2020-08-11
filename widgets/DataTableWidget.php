<?php


namespace fantomx1\datatables\widgets;


use fantomx1\datatables\components\ConfigObject;
use fantomx1\datatables\components\ErrorObject;
use fantomx1\datatables\components\IniObject;
use fantomx1\datatables\components\QueryBuilder;
use fantomx1\datatables\components\SignalHandlers;
use fantomx1\datatables\plugins\queryExecutor\classes\YiiQueryExecutorPlugin;
use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;
use fantomx1\PackagesAssetsSupport;

/**
 * Class DataTableWidget
 * @package fantomx1\datatables
 */
class DataTableWidget extends AbstractWidget
{


    /**
     * @var string
     */
    private $name;
    /**
     * @var
     */
    private $columnsDefinition;

    /**
     * @var ConfigObject
     */
    public $_assoc_config;

    /**
     * @var IniObject
     */
    public $_assoc_ini;


    /**
     * DataTableWidget constructor.
     */
    public function __construct()
    {

        $this->_assoc_ini = new IniObject();

        $config = [
            'flags' => [
                'allFilterable' => false
            ]
        ];

        $this->_assoc_config = new ConfigObject($config);

        // var_dump(debug_backtrace());

        $caller = debug_backtrace()[1];
        $this->name = $caller['class'] .' '.$caller['function'];
    }




    /**
     * @return mixed|void
     * @throws \Exception
     */
    public function run()
    {
        $this->initQueryExecutor();

        $executor = static::$assoc_queryExecutor;

        $queryBuilder = new QueryBuilder();
        $sql = $queryBuilder->buildCountQuery($this->query);

        // 1st execute to find count
        $executor->execute($sql);

        $count = $executor->execute("SELECT FOUND_ROWS()");


        $this->paginator = $paginator = new PaginatorWidget($this);
        $paginator->calculatePagination($count[0]['FOUND_ROWS()']);


        // if isset columns definition && !isset isset($_SESSION[$this->getName()."_sortBy"]['column'])

        $sh = new SignalHandlers();
        $sh->setName($this->getName())
            ->setColumnsDefinition($this->columnsDefinition);

        $sessionSort = $sh->sortSignalEventListener();

        if (!empty($sessionSort)) {
            $this->query .= $queryBuilder->orderByClause($sessionSort);
        }

        //$query = $this->addLimitClause($paginator, $this->query);
        $query = $queryBuilder->addLimitClause($paginator, $this->query);

        $data = $executor->execute($query);

        $assetsHandler = new PackagesAssetsSupport();

        $header = $data[0] ?? [];
        $this->render(
            "index",
            [
                'header'            => $header,
                'data'              => $data,
                'count'             => $count,
                'paginator'         => $paginator,
                'columnsDefinition' => $this->columnsDefinition,
                'assetsHandler'     => $assetsHandler,
                'rootDir'           => __DIR__,
                'config'            => $this->_assoc_config
            ]
        );
    }

    /**
     * @throws \Exception
     */
    private function initQueryExecutor(): void
    {
        // @TODO: two asterisks, maybe even var name not necessary
        /** @var \fantomx1\datatables\components\IniObject $assoc_ini */

        $assoc_ini = $this->_assoc_ini;


        if ($iniQueryExec = $assoc_ini->getIni(IniObject::INI_QUERY_EXECUTOR)) {

            static::$assoc_queryExecutor = new $iniQueryExec();

            if (!is_a(static::$assoc_queryExecutor, QueryExecutorPluginInterface::class)) {
                throw new \Exception(
                    ErrorObject::errorTranslate(ErrorObject::ERROR_MIN1),
                    ErrorObject::ERROR_MIN1
                );
            }

        }

        if (!static::$assoc_queryExecutor) {
            // @TODO: emmit some warning of not being set, or being a default in GUI
            static::setQueryExecutor(
                new YiiQueryExecutorPlugin()
            );
        }

    }


}
