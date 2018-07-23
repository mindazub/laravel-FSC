<?php
/**
 * Created by PhpStorm.
 * User: mind
 * Date: 18.7.23
 * Time: 18.04
 */

namespace App\DTO;


/**
 * Class AuthorDTO
 * @package App\DTO
 */
class AuthorDTO extends BaseDTO
{
    /**
     * @var int
     */
    private $authorId;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;

    /**
     * @param int $authorId
     * @return AuthorDTO
     */
    public function setAuthorId(int $authorId): AuthorDTO
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @param string $firstName
     * @return AuthorDTO
     */
    public function setFirstName(string $firstName): AuthorDTO
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string $lastName
     * @return AuthorDTO
     */
    public function setLastName(string $lastName): AuthorDTO
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @return string
     */
    private function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * niekur nenaudosim tai darom private
     * @return string
     */

    private function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    private function getFullName(): string
    {
        /**
         * GALI BUTI  ir %d integer or %f float
         */
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }



    /**
     * @return array
     */
    protected function jsonData(): array
    {
        // TODO: Implement jsonData() method.
        return [
            'author_id' => $this->getAuthorId(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'full_name' => $this->getFullName(),
        ];
    }
}