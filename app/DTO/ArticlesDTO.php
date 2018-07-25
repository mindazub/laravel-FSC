<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.24
 * Time: 18.59
 */

namespace App\DTO;


use App\Article;
use App\DTO\Interfaces\ArticleDTOInterface;
use Exception;
use Illuminate\Support\Collection;

class ArticlesDTO extends BaseDTO
{

    private $collectionData;

    /**
     * ArticlesDTO constructor.
     */
    public function __construct()
    {
        $this->collectionData = collect();
    }

    /**
     * @param ArticleDTOInterface $articleDTO
     * @return ArticlesDTO
     */
    public function setArticle(ArticleDTOInterface $articleDTO): ArticlesDTO
    {

        $this->collectionData->push($articleDTO);

        return $this;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'data' => $this->collectionData
        ];
    }
}