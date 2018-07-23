<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.23
 * Time: 19.23
 */

namespace App\DTO;


class CategoryDTO extends BaseDTO

{
    private $categoryId;

    /**
     * @var string
     */
    private $title;

    /**
     * @return mixed
     */

    private $slug;

    /**
     * @param mixed $slug
     * @return CategoryDTO
     */
    public function setSlug($slug): CategoryDTO
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     * @return CategoryDTO
     */
    public function setCategoryId($categoryId): CategoryDTO
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return CategoryDTO
     */
    public function setTitle($title): CategoryDTO
    {
        $this->title = $title;

        return $this;


    }


    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'categoryId' => $this->getCategoryId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),

        ];
    }
}