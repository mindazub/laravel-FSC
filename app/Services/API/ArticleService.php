<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.16
 * Time: 18.55
 */

declare(strict_types=1);

namespace App\Services\API;

use App\DTO\ArticleDTO;
use App\DTO\ArticleFullDTO;
use App\DTO\ArticlesDTO;
use App\DTO\AuthorDTO;
use App\DTO\CategoryDTO;
use App\DTO\CategoriesDTO;
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

//        dd($articles);

        if ($articles->isEmpty()) {
            throw ArticleException::noData();
        }

        $articlesDTO = new ArticlesDTO();

//        dd($articlesDTO);

        foreach ($articles as $article) {

            $articlesDTO->setArticle(
                (new ArticleDTO())
                    ->setArticleId($article->id)
                    ->setTitle($article->title)
                    ->setDescription($article->description)
                    ->setSlug($article->slug)
            );
        }

//        dd($articles);


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
        $articles = Article::with('author', 'categories')->paginate(self::PER_PAGE, ['*'], 'page', $page);

//        dd($articles);

        if ($articles->isEmpty()) {
            throw ArticleException::noData();
        }

        $articlesDTO = new ArticlesDTO();

        foreach ($articles as $article) {
            /** @var category $categoryDTO */
            $categoriesDTO = new CategoriesDTO();
            foreach ($article->categories as $category) {
                $categoriesDTO->setCategory(
                    (new CategoryDTO())
                        ->setCategoryId($category->categoryId)
                        ->setTitle($category->title)
                        ->setSlug($category->slug)

                );
            }
            $authorDTO = (new AuthorDTO())
//                ->setAuthorId($article->author->authorId)
                ->setAuthorId(1)
                ->setFirstName($article->author->firstName)
                ->setLastName($article->author->lastName);

            dd($authorDTO);

            $articleFullDTO = new ArticleFullDTO(
                (new ArticleDTO)
                    ->setArticleId($article->articleId)
                    ->setTitle($article->title)
                    ->setSlug($article->slug)
                    ->setDescription($article->description),
                $authorDTO,
                collect($categoriesDTO)->get('data')
            );
            $articlesDTO->setArticle($articleFullDTO);
        }

        return new PaginatorDTO(
            $articles->currentPage(),
            collect($articlesDTO)->get('data'),
            $articles->total(),
            $articles->lastPage(),
            $articles->perPage(),
            $articles->nextPageUrl(),
            $articles->previousPageUrl()
        );

    }

    /**
     * @param int $articleId
     * @return ArticleDTO
     */
    public function getByIdForApi(int $articleId = 1): ArticleDTO
    {

        $article = Article::findOrFail($articleId);

        $dto = new ArticleDTO();


        return $dto->setArticleId($article->id)
            ->setTitle($article->title)
            ->setDescription($article->description)
            ->setSlug($article->slug);


    }


    /**
     * @param int $articleId
     * @return ArticleFullDTO
     */
    public function getByIdFull(int $articleId): ArticleFullDTO
    {

        $article = Article::with('author', 'categories')->findOrFail($articleId);

//dd($article);

        $articleDTO = (new ArticleDTO)->setArticleId($article->id)
            ->setTitle($article->title)
            ->setSlug($article->slug)
            ->setDescription($article->description);

//        dd($articleDTO);

        $authorDTO = (new AuthorDTO)
            ->setAuthorId($article->author->id)
            ->setFirstName($article->author->first_name)
            ->setLastName($article->author->last_name);

//dd($authorDTO);

        $categoriesDTO = new CategoriesDTO();

//dd($categoriesDTO);


        foreach ($article->categories as $category) {
            $categoriesDTO->setCategory(
                (new CategoryDTO)
                    ->setCategoryId($category->id)
                    ->setTitle($category->title)
                    ->setSlug($category->slug)
            );
        }
        return new ArticleFullDTO($articleDTO, $authorDTO, $categoriesDTO);
    }
}