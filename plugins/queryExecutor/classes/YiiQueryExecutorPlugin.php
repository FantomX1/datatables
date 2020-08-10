<?php


namespace fantomx1\datatables\plugins\queryExecutor\classes;




use fantomx1\datatables\plugins\queryExecutor\pluginInterface\QueryExecutorPluginInterface;

/**
 * Class YiiQueryExecutorPlugin
 * @package fantomx1\datatables\plugins\queryExecutor\classes
 */
class YiiQueryExecutorPlugin implements QueryExecutorPluginInterface

{

    /**
     * @param $query
     * @return array
     * @throws \yii\db\Exception
     */
    public function execute($query): array
    {
        return \Yii::$app->db->createCommand($query)->queryAll();
    }
}
