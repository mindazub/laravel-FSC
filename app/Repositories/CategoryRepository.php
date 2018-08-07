<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.8.6
 * Time: 20.39
 */

namespace App\Repositories;


use App\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    /**
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function getBySlug(string $slug)
    {
        return $this->makeQuery()
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param string $slug
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Exception
     */
    public function getBySlugAndNotId(string $slug, int $id)
    {
        return $this->getBySlugBuilder($slug)
            ->where('id', '!=', $id)
            ->first();
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Exception
     */
    private function getBySlugBuilder(string $slug): Builder
    {
        return $this->makeQuery()
            ->where('slug', $slug);
    }
}