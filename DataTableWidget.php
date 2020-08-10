<?php


namespace fantomx1\datatables;


use fantomx1\datatables\plugins\queryExecutor\classes\YiiQueryExecutorPlugin;
use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;
use fantomx1\PackagesAssetsSupport;

/**
 * Class DataTableWidget
 * @package fantomx1\datatables
 */
class DataTableWidget extends AbstractWidget
{

    private $queryExecutor ;
    private $paginator;

    /**
     * @var
     */
    private static $ini;

    /**
     *
     */
    const INI_QUERY_EXECUTOR = 1;


    /**
     * @var
     */
    private static $queryExecutor ;
    /**
     * @var
     */
    private $query;
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
    public $config;


    /**
     * @var array
     */
    public $errors = [
        -1 => '"Configured class for a query executor is not a query executor plugin."s'
    ];

    /**
     * DataTableWidget constructor.
     */
    public function __construct()
    {

        $config = [
            'flags' => [
                'allFilterable' => false
            ]
        ];

        $this->config = new ConfigObject($config);

        // var_dump(debug_backtrace());

        $caller =  debug_backtrace()[1];
        $this->name =$caller['class'] .' '.$caller['function'];
    }



    /**
     * @param $initItem
     * @param $value
     */
    public static function setIni($initItem, $value)
    {
        static::$ini[$initItem] = $value;
    }

    /**
     * @param QueryExecutorPluginInterface $queryExecutor
     */
    public static function setQueryExecutor(QueryExecutorPluginInterface $queryExecutor)
    {

        static::$queryExecutor = $queryExecutor;

    }


    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;

    }


    /**
     * @param array $definition
     */
    public function setColumnsDefinition(array $definition)
    {

        $this->columnsDefinition = $definition;

    }

    /**
     * @param $query
     */
    public function setQuery($query)
    {

        $this->query = $query;
        // a ked nie parametre, tak vlastny, data objekt a na ten link, ale niekde treba, akoze pure function,
        // ak nie data objekt, tak pole, ale toto je zaroven plain old, co aj naplnita  oddelenie kvazi este nezistene
        // od kreslenia, toboz logiky adat

    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param $code
     * @return mixed
     * @throws \Exception
     */
    public function errorTranslate($code)
    {

        if (!isset($this->errors[$code])) {
            throw new \Exception("No error defined with a code ".$code);
        }

        return $this->errors[$code];
    }

    /**
     * @return mixed|void
     * @throws \Exception
     */
    public function run()
    {
        $this->initQueryExecutor();

        $executor = static::$queryExecutor;

        $sql = 'select SQL_CALC_FOUND_ROWS '
               .ltrim(trim(str_replace('SELECT', 'select', $this->query)), 'select');


        // 1st execute to find count
        $executor->execute($sql);


        $count = $executor->execute("SELECT FOUND_ROWS()");


        var_dump($count);


        //        $paginator = new PaginatorWidget();
//        $paginator->setData(
//             [
////                'pages' => $totalPages,
////                'page' => $page
//            ]
//        );

        $this->paginator = $paginator = new PaginatorWidget($this);
        $paginator->calculatePagination($count[0]['FOUND_ROWS()']);


        // if isset columns definition && !isset isset($_SESSION[$this->getName()."_sortBy"]['column'])

        SignalHandlers::$name = $this->getName();
        SignalHandlers::$columnsDefinition = $this->columnsDefinition;
        $sessionSort = SignalHandlers::sortEventSignalListener();

        if (!empty($sessionSort)) {

            $this->query .= " ORDER BY " . $sessionSort['column'] . ' ' . $sessionSort['dir'];
        }

        $query = $this->addLimitClause($paginator, $this->query);

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
                'config'            => $this->config
            ]
        );


    }

    /**
     * @param PaginatorWidget $paginator
     */
    private function addLimitClause(
        PaginatorWidget $paginator,
        $query
    )
    {
        $onPage = $paginator->getOnPage();

        $page        = $this->paginator->getPage();
        return $query .= " LIMIT " . ($page - 1) * $onPage . "," . $onPage;
    }



    /**
     * @throws \Exception
     */
    private function initQueryExecutor(): void
    {
        if (isset(static::$ini[static::INI_QUERY_EXECUTOR])) {

            static::$queryExecutor = new static::$ini[static::INI_QUERY_EXECUTOR]();

            if (!is_a(static::$queryExecutor, QueryExecutorPluginInterface::class)) {
                throw new \Exception($this->errorTranslate(-1), -1);
            }

        }

        if (!static::$queryExecutor) {
            // @TODO: emmit some warning of not being set, or being a default in GUI
            static::setQueryExecutor(
                new YiiQueryExecutorPlugin()
            );
        }

    }


}
