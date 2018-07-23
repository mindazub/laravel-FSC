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
use App\Exceptions\CategoryException;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CategoryService
 * @package App\Services\API
 */
class CategoryService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $authors */
        $categories = Category::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($categories->isEmpty()) {
            throw CategoryException::noData();
        }

        return $categories;
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
     * @return Category
     */
    public function getById(int $categoryId = 1): Category
    {
        //dd($categoryId);
        return  Category::findOrFail($categoryId);
    }
}
