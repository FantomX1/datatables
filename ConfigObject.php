<?php


namespace fantomx1\datatables;


/**
 * Class ConfigObject
 * @package fantomx1\datatables
 */
class ConfigObject
{


    private $backRef = DataTableWidget::class;

    /**
     * @var
     */
    public $config;

    /**
     * ConfigObject constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


    /**
     *
     */
    public function setAllFilterable()
    {
        $this->config['flags']['allFilterable'] = true;

    }


    /**
     * @return bool
     */
    public function getAllFilterable()
    {

        return $this->config['flags']['allFilterable'] == true;

    }


}
