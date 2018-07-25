<?php
/**
 * Created by PhpStorm.
 * User: mindazub
 * Date: 2018.07.20
 * Time: 14:19
 */


declare(strict_types = 1);

namespace App\Services\API;

use App\Category;
use App\DTO\CategoriesDTO;
use App\DTO\CategoryDTO;
use App\Exceptions\CategoryException;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CategoryService
 * @package App\Services\API
 */
class CategoryService extends ApiService
{

    const PER_PAGE = 3;

    /**
     * @param int $page
     * @return PaginatorDTO
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): CategoriesDTO
    {
        /** @var LengthAwarePaginator $authors */
        $categories = Category::paginate(self::PER_PAGE);

//        dd($categories);

        if ($categories->isEmpty()) {
            throw CategoryException::noData();
        }

        $categoriesDTO = new CategoriesDTO();


        foreach ($categories as $category)
        {
            $categoriesDTO->setCategory(
                (new CategoryDTO())
                        ->setCategoryId($category->id)
                        ->setTitle($category->title)
                        ->setSlug($category->slug)
                );
        }

//        dd($categoriesDTO);
//        dd($categories);
//        return new PaginatorDTO(
//            $categories->currentPage(),
//            collect($categoriesDTO)->get('data'),
//            $categories->lastPage(),
//            $categories->total(),
//            $categories->perPage(),
//            $categories->nextPageUrl(),
//            $categories->previousPageUrl()
//            );
        return $categoriesDTO;
    }

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $articles */
        $categories = Category::with( 'articles')->paginate(self::PER_PAGE,['*'], 'page', $page);

        if($categories ->isEmpty())
        {
            throw CategoryException::noData();
        }

        return $categories;

    }

    /**
     * @param int $categoryId
     * @return CategoryDTO
     */
    public function getById(int $categoryId = 1): CategoryDTO
    {
        //dd($categoryId);

        $category = Category::findOrFail($categoryId);


        $dto = new CategoryDTO();

        return $dto->setCategoryId($category->id)
        ->setTitle($category->title)
        ->setSlug($category->slug);


    }
}
