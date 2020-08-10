<?php


namespace fantomx1\datatables\components;


/**
 * Class ErrorObject
 * @package fantomx1\datatables\components
 */
class ErrorObject
{


    /**
     *
     */
    const ERROR_MIN1 = -1;

    /**
     * @var array
     */
    public $errors = [
        ErrorObject::ERROR_MIN1 => 'Configured class for a query executor is not a query executor plugin.'
    ];

    /**
     * @param $code
     * @return mixed
     * @throws \Exception
     */
    public static function errorTranslate($code)
    {

        if (!isset(static::errors[$code])) {
            throw new \Exception("No error defined with a code ".$code);
        }

        return static::errors[$code];
    }

}
