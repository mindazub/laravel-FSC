<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.16
 * Time: 18.55
 */

declare(strict_types = 1);

namespace App\Services\API;

use App\Exceptions\ArticleException;
use App\Services\ApiService;
use \Exception;
use App\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticleService extends ApiService
{
    const PER_PAGE = 2;

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws ArticleException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::paginate(self::PER_PAGE,['*'], 'page', $page);

        if($articles->isEmpty())
        {
                throw ArticleException::noData();
        }

        return $articles;
    }
}