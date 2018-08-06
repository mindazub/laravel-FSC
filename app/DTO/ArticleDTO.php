<?php
/**
 * @copyright C VR Solutions 2018
 *
 * This software is the property of VR Solutions
 * and is protected by copyright law – it is NOT freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * Contact VR Solutions:
 * E-mail: vytautas.rimeikis@gmail.com
 * http://www.vrwebdeveloper.lt
 */

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
