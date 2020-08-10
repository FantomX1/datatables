<?php


namespace fantomx1\datatables\components;


use fantomx1\datatables\DataTableWidget;

/**
 * usage from outside
 *    $articleTableWidget = new DataTableWidget();
 *    $articleTableWidget->_assoc_ini->setIni(
 *    $articleTableWidget->_assoc_ini::INI_QUERY_EXECUTOR,
 *    YiiQueryExecutorPlugin::class
 * );
 *
 * Class IniObject
 * @package fantomx1\datatables\components
 */
class IniObject
{


    /**
     * @var string
     */
    private $backRef = DataTableWidget::class;

    /**
     * keep not static to shared storage private static $ini;
     * @var
     */
    private  $ini;


    /**
     *
     */
    const INI_QUERY_EXECUTOR = 1;


    /**
     *         Original static call
     *         DataTableWidget::setIni(
     *            DataTableWidget::INI_QUERY_EXECUTOR,
     *            YiiQueryExecutorPlugin::class
     *        );
     *
     *
     * @param $initItem
     * @param $value
     */
    public function setIni($initItem, $value)
    {
        $this->ini[$initItem] = $value;
    }


    /**
     * @return mixed
     */
    public  function getIni($item)
    {
        $item = '';

        if (isset($this->ini[$item])) {
            $item = $this->ini[$item];
        }

        return $item;
    }
}
