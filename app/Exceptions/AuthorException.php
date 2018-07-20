<?php
/**
 * Created by PhpStorm.
 * User: mindazub
 * Date: 2018.07.20
 * Time: 14:21
 */
declare(strict_types = 1);

namespace App\Exceptions;

use Exception;

class AuthorException extends \Exception
{
    const NO_DATA_FOUND = 1001;

    public function noData(): AuthorException
    {
        return new self('No data found', self::NO_DATA_FOUND);
    }
}