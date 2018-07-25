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
use App\DTO\AuthorDTO;
use App\Exceptions\AuthorException;
use App\Services\ApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AuthorService
 * @package App\Services\API
 */
class AuthorService extends ApiService
{

    const PER_PAGE = 3  ;

    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getPaginateData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $authors */
        $authors = Author::paginate(self::PER_PAGE);

        if ($authors->isEmpty()) {
            throw AuthorException::noData();
        }

        return $authors;
    }


    /**
     * @param int $page
     * @return LengthAwarePaginator
     * @throws \App\Exceptions\ApiDataException
     */
    public function getFullData(int $page = 1): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $articles */
        $authors = Author::with( 'articles')->paginate(self::PER_PAGE,['*'], 'page', $page);

//        dd($authors);

        if($authors ->isEmpty())
        {
            throw AuthorException::noData();
        }

        return $authors;

    }


    /**
     * @param int $authorId
     * @return AuthorDTO
     * @throws \App\Exceptions\ApiDataException
     */
    public function getById(int $authorId): AuthorDTO
    {
        /** @var Author $author */
        $author = Author::find($authorId);

        if (is_null($author)){
            throw AuthorException::noData();
        }

        $dto = new AuthorDTO();

        return $dto->setAuthorId($author->id)
            ->setFirstName($author->first_name)
            ->setLastName($author->last_name);
    }
}
