<?php


namespace fantomx1\datatables;


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
     * @var
     */
    protected static $assoc_queryExecutor ;

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
        return $this->getDefaultViewsDir("./templates");
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
