<?php


namespace App\DTO;

use App\DTO\Interfaces\ArticleDTOInterface;

/**
 * Class ArticleDTO
 * @package App\DTO
 */
class ArticleDTO extends BaseDTO implements ArticleDTOInterface
{
    /**
     * @var
     */
    private $articleId;

    /**
     * @var
     */
    private $title;
    /**
     * @return mixed
     */
    public function getArticleId(): string
    {
        return $this->articleId;
    }
    /**
     * @param mixed $articleId
     * @return ArticleDTO
     */
    public function setArticleId($articleId): ArticleDTO
    {
        $this->articleId = $articleId;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * @param mixed $title
     * @return ArticleDTO
     */
    public function setTitle($title): ArticleDTO
    {
        $this->title = $title;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * @param mixed $description
     * @return ArticleDTO
     */
    public function setDescription($description): ArticleDTO
    {
        $this->description = $description;
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
     * @param mixed $slug
     * @return ArticleDTO
     */
    public function setSlug($slug): ArticleDTO
    {
        $this->slug = $slug;
        return $this;
    }
    /**
     * @var
     */
    private $description;

    /**
     * @var
     */
    private $slug;





    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'articleId' => $this->getArticleId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'slug' => $this->getSlug(),
        ];

    }
}