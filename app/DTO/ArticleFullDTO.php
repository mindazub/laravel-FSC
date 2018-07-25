<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.25
 * Time: 17.59
 */

namespace App\DTO;
use App\DTO\Interfaces\ArticleDTOInterface;


class ArticleFullDTO extends BaseDTO implements ArticleDTOInterface
{
    /**
     * @var ArticleDTO
     */
    private $articleDTO;
    /**
     *
     * @var AuthorDTO
     */
    private $authorDTO;
    /**
     * @var CategoriesDTO
     */
    private $categoriesDTO;


    /**
     * ArticleFullDTO constructor.
     * @param $articleDTO
     * @param $authorDTO
     * @param $categoryDTO
     */
    public function __construct(ArticleDTO $articleDTO, AuthorDTO $authorDTO, CategoriesDTO $categoriesDTO)
    {


        $this->articleDTO = $articleDTO;
        $this->authorDTO = $authorDTO;
        $this->categoriesDTO = $categoriesDTO;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {

        // TODO: Implement jsonData() method.
        return [
            'data' => $this->articleDTO,
            'author' => $this->authorDTO,
            'category' => collect($this->categoriesDTO)->get('data'),
        ];
    }
}