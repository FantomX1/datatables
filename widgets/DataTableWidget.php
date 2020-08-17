<?php


namespace fantomx1\datatables\widgets;


use fantomx1\datatables\components\definitionsAssembler\Column;
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
     * @TODO: WIP
     * protected static $signalIdentifier = "dd_";
     */

    // ==================================================================================================

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


        $this->_assoc_config = new ConfigObject();

        $this->_assoc_config->setDefaults();

        // var_dump(debug_backtrace());

        $caller = debug_backtrace()[1];
        $this->name = $caller['class'] .' '.$caller['function'];
    }


    /**
     * must be called, otherwise the executor won't be available
     * @throws \Exception
     */
    public function init()
    {
        // two ways of setting, therefore dont get the executor via set/init method 'initQueryExecutor' (since also static set avaialble)
        // ini settings for static, could be static, albeit not addressed transitively, but if transits through
        // multiple objects
        $this->initQueryExecutor();


        // pre call common ini stuff used in at least 2 different methods, run vs column, ensure sometimes its logged if this not called
        // will fail on accessing it
        // how to ensure it is called though just after ini settings, or is it a common logic
    }

    /**
     * @return mixed|void
     * @throws \Exception
     */
    public function run()
    {

        $executor = static::$assoc_queryExecutor;

        $queryBuilder = new QueryBuilder($this->_assoc_config);
        $sql = $queryBuilder->buildCountQuery($this->query);

        // 1st execute to find count
        $executor->execute($sql);

        $count = $executor->execute("SELECT FOUND_ROWS()");


        $this->paginator = $paginator = new PaginatorWidget($this);
        $paginator->calculatePagination($count[0]['FOUND_ROWS()']);


        // if isset columns definition && !isset isset($_SESSION[$this->getName()."_sortBy"]['column'])

        $sh = new SignalHandlers($this->_assoc_config);
        $sh->setName($this->getName())
            ->setColumnsDefinition($this->columnsDefinition);

        $sessionSort = $sh->sortSignalEventListener();

        $filter = $sh->filterSignalEventListener();

        if (!empty($filter)) {
            $this->query .= $queryBuilder->filterClause($filter);
        }

        if (!empty($sessionSort)) {
            $this->query .= $queryBuilder->orderByClause($sessionSort);
        }

        //$query = $this->addLimitClause($paginator, $this->query);
        $query = $queryBuilder->addLimitClause($paginator, $this->query);

        $data = $executor->execute($query);

        // workaround for empty result having still the full number of selected columns
        $headerQuery =  "SELECT * , count(*) as _count from (".$query.") a";
        $header  = $executor->execute($headerQuery);
        $header = $header[0];

        // @TODO: pass extended class render method on the background
        $assetsHandler = new PackagesAssetsSupport();


        $config = $this->_assoc_config->getConfig();

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
                'config'            => $this->_assoc_config,
                'filterConf'        => [
                    'filtering' => $filter,
                    'filterField' => $config['filterField']
                ]
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function initQueryExecutor(): void
    {
        // @TODO: two asterisks, maybe even var name not necessary
        /** @var \fantomx1\datatables\components\IniObject $assoc_ini */

        $assoc_ini = $this->_assoc_ini;


        // if is object configured, passed via  a ini setting association object
        if ($iniQueryExec = $assoc_ini->getIni(IniObject::INI_QUERY_EXECUTOR)) {

            static::$assoc_queryExecutor = new $iniQueryExec();

            if (!is_a(static::$assoc_queryExecutor, QueryExecutorPluginInterface::class)) {
                throw new \Exception(
                    ErrorObject::errorTranslate(ErrorObject::ERROR_MIN1),
                    ErrorObject::ERROR_MIN1
                );
            }

        }

        // fallback to Yii query executor plugin, @TODO: add support not only framework-specifically,
        // but also database specifically for non-framework users, eg for those using pdo, or various db system
        // or just a simple callable closure for that case
        if (!static::$assoc_queryExecutor) {
            // @TODO: emmit some warning of not being set, or being a default in GUI
            static::setQueryExecutor(
                new YiiQueryExecutorPlugin()
            );
        }

    }


}
