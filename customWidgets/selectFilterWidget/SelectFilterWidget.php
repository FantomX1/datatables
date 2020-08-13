<?php


namespace fantomx1\datatables\customWidgets\selectFilterWidget;


use fantomx1\ViewLocatorRenderTrait;

/**
 * Class SelectFilterWidget
 * @package fantomx1\datatables\customWidgets\selectFilterWidget
 */
class SelectFilterWidget
{
    use ViewLocatorRenderTrait;

    /**
     * @param $name
     */
    public function run($name)
    {



        //
        $this->render(
            "index",
            [
               'name' => $name
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
        return $this->getDefaultViewsDir();
    }
}
