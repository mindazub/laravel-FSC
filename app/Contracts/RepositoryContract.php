<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;


/**
 * Interface RepositoryContract
 * @package App\Contracts
 */

interface RepositoryContract
{

    /**
     * @return string
     */
    public function model(): string;

    /**
     * @return Builder
     */
    public function makeQuery(): Builder;

}