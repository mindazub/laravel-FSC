<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.8.6
 * Time: 18.18
 */

declare(strict_types = 1);

namespace App\Repositories;


use App\Article;

class ArticleRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Article::class;
    }

    public function getBySlugAndNotById(string $slug, int $id)
    {
        return $this->getBySlugBuilder($slug)
            ->where('id', '!=', $id)
            ->first();
    }

    /**
     *
     * Return first from DB if not found
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     * @throws \Exception
     */
    public function getBySlug(string $slug)
    {
        return $this->getBySlugBuilder($slug)->first();

    }

    /**
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function getBySlugBuilder(string $slug)
    {
        return $this->makeQuery()
            ->where('slug', $slug);

    }

}