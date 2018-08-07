<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.8.7
 * Time: 17.55
 */

declare(strict_types = 1);

namespace App\Repositories;


use App\User;

class UserRepository extends Repository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}