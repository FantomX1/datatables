<?php


namespace fantomx1\datatables;


use fantomx1\PackagesAssetsSupport;
use fantomx1\RequestHandler;

class DataTableWidget extends AbstractWidget
{

    private $queryExecutor ;
    private $paginator;
    private $query;
    private $name;
    private $columnsDefinition;
    
    public $config;


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



    public function setQueryExecutor(callable $queryExecutor)
    {

        $this->queryExecutor = $queryExecutor;


    }


    public function setName($name)
    {
        $this->name = $name;

    }


    public function setColumnsDefinition(array $definition)
    {

        $this->columnsDefinition = $definition;

    }

    public function setQuery($query)
    {

        $this->query = $query;
        // a ked nie parametre, tak vlastny, data objekt a na ten link, ale niekde treba, akoze pure function,
        // ak nie data objekt, tak pole, ale toto je zaroven plain old, co aj naplnita  oddelenie kvazi este nezistene
        // od kreslenia, toboz logiky adat

    }

    public function getName()
    {
        return $this->name;

    }

    public function run()
    {



        $this->setQueryExecutor(
            function($query) {
                return \Yii::$app->db->createCommand($query)->queryAll();
            }

        );


        $executor = $this->queryExecutor;






        $sql = 'select SQL_CALC_FOUND_ROWS '
               .ltrim(trim(str_replace('SELECT', 'select', $this->query)), 'select');


        $executor($sql);


        $count = $executor("SELECT FOUND_ROWS()");


        var_dump($count);








        $this->paginator = $paginator = new PaginatorWidget($this);
        $paginator->calculatePagination($count[0]['FOUND_ROWS()']);


        // if isset columns definition && !isset isset($_SESSION[$this->getName()."_sortBy"]['column'])




        $sessionSort = &$_SESSION[$this->getName()."_sortBy"] ?? [];

        if (isset($_GET['sortBy']) &&
            // if request for sorting and there is no definition or the requested column is allowed to be sorted
            (empty($this->columnsDefinition) ||
             !empty($this->columnsDefinition[$_GET['sortBy']]['orderable'])
            )


        ) {




            //if (isset($sessionSort['column']) &&
            if (!empty($sessionSort['column']) &&
                $sessionSort['column'] == $_GET['sortBy'] &&
                $sessionSort['dir'] == "ASC"
            ) {
                $sessionSort['dir'] = "DESC";

            } else {

                // sometimes must be else, before it would affect the order as if prior set originated from the
                // previous session, whereas it's also a default overwriting always
                $sessionSort['column'] = $_GET['sortBy'];
                $sessionSort['dir'] = "ASC";

            }

        }


        if (!empty($sessionSort)) {

            $this->query .= " ORDER BY ".$sessionSort['column'].' '.$sessionSort['dir'];
        }

        $query = $this->addLimitClause($paginator, $this->query);


        $data = $executor($query);

//        $paginator = new PaginatorWidget();
//        $paginator->setData(
//             [
////                'pages' => $totalPages,
////                'page' => $page
//            ]
//        );

        $assetsHandler = new PackagesAssetsSupport();

        $header = $data[0] ?? [];
        $this->render(
            "index",
            [
                'header' => $header,
                'data' => $data,
                'count' => $count,
                'paginator' => $paginator,
                'columnsDefinition' => $this->columnsDefinition,
                'assetsHandler' => $assetsHandler,
                'rootDir' => __DIR__,
                'config' => $this->config
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


}
