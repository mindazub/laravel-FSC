<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.8.6
 * Time: 18.18
 */

declare(strict_types = 1);

namespace App\Repositories;


use App\Author;

class AuthorRepository extends Repository
{
    public function model(): string
    {
        // TODO: Implement model() method.
        return Author::class;
    }

}