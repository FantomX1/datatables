<?php


namespace fantomx1\datatables\widgets;


use fantomx1\datatables\components\definitionsAssembler\Column;
use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;
use fantomx1\ViewLocator;
use fantomx1\ViewLocatorRenderTrait;

/**
 * Class AbstractWidget
 * @package fantomx1\datatables
 */
abstract class AbstractWidget
{
    use ViewLocatorRenderTrait;

    /**
     * @var QueryExecutorPluginInterface
     */
    public static $assoc_queryExecutor ;

    /**
     * @var
     */
    protected $paginator;

    /**
     * @var
     */
    protected $query;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var
     */
    protected $columnsDefinition;




    /**
     * @param QueryExecutorPluginInterface $queryExecutor
     */
    public static function setQueryExecutor(QueryExecutorPluginInterface $queryExecutor)
    {

        static::$assoc_queryExecutor = $queryExecutor;

    }


    /**
     * @return mixed
     */
    abstract function run();


    /**
     * protected function getViewsDir()
     * {
     * return $this->getDefaultViewsDir();
     * }
     * @return string
     */
    protected function getViewsDir()
    {
        return $this->getDefaultViewsDir("../templates");
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;

    }

    public function column($name)
    {
        $column = new Column();
        $column->setName($name);


        return $column;
    }


    /**
     * @param array $definition
     */
    public function setColumnsDefinition(array $definition)
    {

        $defIndexed=[];
        foreach ($definition as $k=>$def) {
            /** @var Column $def */
            $defIndexed[$def->getName()] = $def;
        }

        $this->columnsDefinition = $defIndexed;

    }

    /**
     * @param $query
     */
    public function setQuery($query)
    {

        $this->query = $query;
        // @TODO: consider separate data-object, not so necessary currently
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    //     protected $associations;

    /**
     * maybe via magc methods, risk overridable but can be mantaing via still magic confusing, if
     * substring _assoc or g(const), even more const, so better magic even though maybe confusing
     * @deprecated
     * @param $index
     * @param $object
     * @throws \Exception
     */
    protected function addAssociation($index, $object)
    {
        if (!isset($this->associations[$index])) {
            throw new \Exception("Unavailable association.");
        }

        $this->associations[$index] = $object;

    }

}
