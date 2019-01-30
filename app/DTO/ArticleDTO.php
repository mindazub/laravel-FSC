<?php


declare(strict_types = 1);

namespace App\DTO;

use App\DTO\Interfaces\ArticleDTOInterface;

/**
 * Class ArticleDTO
 * @package App\DTO
 */
class ArticleDTO extends BaseDTO implements ArticleDTOInterface
{
    /**
     * @var int
     */
    private $articleId;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;

    /**
     * ArticleDTO constructor.
     * @param int $articleId
     * @param string $title
     * @param string|null $description
     */
    public function __construct(int $articleId, string $title, string $description = null)
    {
        $this->articleId = $articleId;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'article_id' => $this->articleId,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
