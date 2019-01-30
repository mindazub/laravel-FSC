<?php

declare(strict_types = 1);

namespace App\DTO;

use App\DTO\Interfaces\ArticleDTOInterface;


/**
 * Class ArticlesDTO
 * @package App\DTO
 */
class ArticlesDTO extends BaseDTO
{
    /**
     * @var \Illuminate\Support\Collection
     */
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
            'data' => $this->collectionData,
        ];
    }
}
