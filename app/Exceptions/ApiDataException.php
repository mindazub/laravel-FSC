<?php

namespace App\Exceptions;

use Exception;

/**
 * Class ApiDataException
 * @package App\Exceptions
 */
class ApiDataException extends Exception
{
    const CODE_NO_DATA = 1001;


    public static function noData(): ApiDataException
    {
        return new static('No Data found and showed', self::CODE_NO_DATA);
    }
}
