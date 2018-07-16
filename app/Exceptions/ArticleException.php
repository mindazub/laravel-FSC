<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use App\Services\API\ArticleService;

class ArticleException extends Exception
{
    const CODE_NO_DATA = 1001;


    public static function noData(): ArticleException
    {
        return new self('No Data found and showed', self::CODE_NO_DATA);
    }


}
