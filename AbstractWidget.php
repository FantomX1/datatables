<?php


namespace fantomx1\datatables;


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
     * @return mixed
     */
    abstract function run();

//
//    /**
//     * @param $template
//     * @param array $vars
//     * @throws \ReflectionException
//     */
//    protected function render($template, array $vars)
//    {
//
//
//        $tl = new ViewLocator();
//        $path = $tl->setViewsDir('./templates')->seek($this);
//
//        extract($vars);
//        include $path.'/'.$template.'.php';
//    }
}
