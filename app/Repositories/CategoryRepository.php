<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.8.6
 * Time: 20.39
 */

namespace App\Repositories;


use App\Category;

class CategoryRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        // TODO: Implement model() method.
        return Category::class;
    }
}