<?php


namespace fantomx1\datatables\components;


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


    public function getConfig()
    {
        return $this->config;
    }

    /**
     * ConfigObject constructor.
     * @param $config
     */
    public function __construct()
    {
     //   $this->config = $config;
    }


    public function setDefaults()
    {

        $config = [
            'flags' => [
                'allFilterable' => false
            ],
            'filterField'=>
                [
                    'name'=>'f',
                    'ids'=>'i',
                    'values'=>'v',
                ]
        ];

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
