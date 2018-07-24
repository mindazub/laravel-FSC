<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.16
 * Time: 18.55
 */

declare(strict_types = 1);

namespace App\Services\API;

use App\DTO\ArticleDTO;
use App\DTO\ArticlesDTO;
use App\DTO\PaginatorDTO;
use App\Exceptions\ApiDataException;
use App\Exceptions\ArticleException;
use App\Services\ApiService;
use \Exception;
use App\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticleService extends ApiService
{
    const PER_PAGE = 3;

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws ApiDataException
     */
    public function getPaginateData(): PaginatorDTO
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::paginate(self::PER_PAGE);

        if($articles->isEmpty())
        {
                throw ArticleException::noData();
        }

        $articlesDTO = new ArticlesDTO();

        foreach ($articles as $article) {

            $articlesDTO->setArticle(
                (new ArticleDTO())
                    ->setArticleId($article->id)
                    ->setTitle($article->title)
                    ->setDescription($article->description)
                ->setSlug($article->slug)
            );
        }

        return new PaginatorDTO(
            $articles->currentPage(),
            collect($articlesDTO)->get('data'),
            $articles->lastPage(),

            $articles->total(),
            $articles->perPage(),
            $articles->nextPageUrl(),
            $articles->previousPageUrl()
        );
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::with('author', 'categories')->paginate(self::PER_PAGE,['*'], 'page', $page);

        if($articles->isEmpty())
        {
            throw ArticleException::noData();
        }

        return $articles;

    }

    /**
     * @param int $articleId
     * @return ArticleDTO
     */
    public function getByIdForApi(int $articleId = 1): ArticleDTO
    {

        $article = Article::findOrFail($articleId);

        $dto = new ArticleDTO();


      return  $dto->setArticleId($article->id)
          ->setTitle($article->title)
          ->setDescription($article->description)
          ->setSlug($article->slug);


    }
}