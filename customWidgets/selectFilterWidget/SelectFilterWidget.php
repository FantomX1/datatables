<?php


namespace fantomx1\datatables\customWidgets\selectFilterWidget;


use fantomx1\ViewLocatorRenderTrait;

/**
 * Class SelectFilter
 * @package fantomx1\datatables\customWidgets\selectFilterWidget
 */
class SelectFilterWidget
{
    use ViewLocatorRenderTrait;

    /**
     * @param $name
     */
    public function run($groupId, $data, $name = "filter")
    {

        $this->render(
            "index",
            [
                'groupId' => $groupId,
                'data' => $data,
                'name' => $name,
            ]
        );
    }

    /**
     * protected function getViewsDir()
     * {
     * return $this->getDefaultViewsDir();
     * }
     * @return string
     */
    protected function getViewsDir()
    {
        return $this->getDefaultViewsDir("./template");
    }
}
