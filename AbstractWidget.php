<?php


namespace fantomx1\datatables;


abstract class AbstractWidget
{


    abstract function run();



    protected function render($template, array $vars)
    {

        $reflect = new \ReflectionClass($this);
        $shortname = $reflect->getShortName();


        extract($vars);
        include __DIR__.'/templates/'.$shortname.'/'.$template.'.php';
    }
}
