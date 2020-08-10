<?php


namespace fantomx1\datatables;


/**
 * Class ConfigObject
 * @package fantomx1\datatables
 */
class ConfigObject
{



    public static $config;

    /**
     * ConfigObject constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public static function setConfig($config)
    {
        static::$config = $config;
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
