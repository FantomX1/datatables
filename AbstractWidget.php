<?php


namespace fantomx1\datatables;


use fantomx1\ViewLocator;

/**
 * Class AbstractWidget
 * @package fantomx1\datatables
 */
abstract class AbstractWidget
{


    /**
     * @return mixed
     */
    abstract function run();


    /**
     * @param $template
     * @param array $vars
     * @throws \ReflectionException
     */
    protected function render($template, array $vars)
    {

        $tl = new ViewLocator();
        $path = $tl->setViewsDir('./templates')->seek($this);

        extract($vars);
        include $path.''.$template.'.php';
    }
}
