<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use App\Services\API\CategoryService;

class CategoryException extends Exception
{
    const CODE_NO_DATA = 1001;


    /**
     * @return CategoryException
     */
    public static function noData(): CategoryException
    {
        return new self('No Data found and showed', self::CODE_NO_DATA);
    }


}
