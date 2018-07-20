<?php
/**
 * Created by PhpStorm.
 * User: mindazub
 * Date: 2018.07.20
 * Time: 14:19
 */


declare(strict_types = 1);

namespace App\Services\API;

use App\Author;
use App\Exceptions\AuthorException;
use App\Services\ApiService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AuthorService
 * @package App\Services\API
 */
class AuthorService extends ApiService
{
    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws AuthorException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $authors */
        $authors = Author::paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($authors->isEmpty()) {
            throw AuthorException::noData();
        }

        return $authors;
    }
}
