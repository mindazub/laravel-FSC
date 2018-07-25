<?php
/**
 * Created by PhpStorm.
 * User: mindazub
 * Date: 2018.07.25
 * Time: 10:29
 */

namespace App\DTO;


class CategoriesDTO extends BaseDTO
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
     * @param CategoryDTO $categoryDTO
     * @return CategoriesDTO
     */
    public function setCategory(CategoryDTO $categoryDTO): CategoriesDTO
    {

        $this->collectionData->push($categoryDTO);


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